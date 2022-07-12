<?php

namespace frontend\controllers;

use common\models\MultipleDistance;
use common\models\User;
use common\models\UserAddress;
use common\models\UserChatDistance;
use common\models\UserDetail;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\db\StaleObjectException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $profileView = '@app/views/_partial/profile';

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index','about','contact','login','signup','chat-distance-create'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','address','detail','view-detail','chat-distance','captcha','chat-distance-create','chat-distance-delete', 'multiple-distance','add-multiple-distance'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'test' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * @param bool $renderAjax
     * @return string|void
     * @throws Exception
     */
    public function actionDetail(bool $renderAjax = false)
    {
        Yii::$app->view->title = 'User Detail';
        $user = User::findOne(['id' => Yii::$app->user->identity->id]);
        $user_detail = UserDetail::findOne(['user_id' =>Yii::$app->user->identity->id]);

        if (!$user_detail){
            $user_detail = new UserDetail();
        }
        $content = [
            'view_name' => 'detail',
            'user' =>$user,
            'user_detail' => $user_detail
        ];
        if ($renderAjax) {
            return $this->renderAjax($this->profileView, $content);
        }
        if (Yii::$app->request->isPost) {
            if ($user_detail->load(Yii::$app->request->post())) {
                $user_detail->user_id = Yii::$app->user->identity->id;
                if ($user_detail->save()){
                    return $this->actionAddress(true);
                }
            }
        }else{
            return $this->render($this->profileView, $content);
        }
    }

    /**
     * @param bool $renderAjax
     * @return string|void
     * @throws Exception
     */
    public function actionAddress(bool $renderAjax = false)
    {
        Yii::$app->view->title = 'User Address';
        $user = User::findOne(['id' => Yii::$app->user->identity->id]);
        $user_address = UserAddress::findOne(['user_id' => Yii::$app->user->identity->id]);

        if (!$user_address){
            $user_address = new UserAddress();
        }
        $content = [
            'view_name' => 'address',
            'user_address' => $user_address,
            'user' =>$user,
        ];
        if ($renderAjax) {
            return $this->renderAjax($this->profileView, $content);
        }
        if (Yii::$app->request->isPost){
            if ($user_address->load(Yii::$app->request->post()) && Yii::$app->request->isPjax) {
                $user_address->user_id = Yii::$app->user->identity->id;
                $user_address->save();
                return $this->actionMultipleDistance(true);
            }
        }else{
            return $this->render($this->profileView, $content);
        }
    }

    /**
     * @param bool $renderAjax
     * @return string
     */
    public function actionChatDistance(bool $renderAjax = false): string
    {
        Yii::$app->view->title = 'User Chat';
        $distance = new UserChatDistance();
        $content = [
            'view_name' => 'chat-distance',
            'distance' => $distance
        ];
        if ($renderAjax)
        {
            return $this->renderAjax($this->profileView, $content);
        }
     return $this->render($this->profileView, $content);
    }

    /**
     * @param $value
     * @return string
     */
    public function actionAddMultipleDistance($value): string
    {
        return $this->renderAjax('partial/add-multiple-distance',['counter'=>$value]);
    }

    /**
     * @param bool $renderAjax
     * @return string
     * @throws Exception
     */

    public function actionMultipleDistance(bool $renderAjax = false): string
    {
        Yii::$app->view->title = 'Multiple Distance';
        $multiple_distance = new MultipleDistance();
        $user_address = UserAddress::findOne(['user_id' => Yii::$app->user->identity->id]);

        if ($multiple_distance->load(Yii::$app->request->post())){
            foreach ($multiple_distance as $item) {
                /** @var $item MultipleDistance */
                $item->uuid = Yii::$app->security->generateRandomString(36);
                $item->user_id = Yii::$app->user->identity->id;
                $item->save();
            }
            return $this->actionViewDetail(true);
        }
        $content = [
            'view_name' => 'multiple-distance',
            'multiple_distance' => $multiple_distance,
            'user_address' => $user_address
        ];
        if ($renderAjax)
        {
            return $this->renderAjax($this->profileView, $content);
        }
        return $this->render($this->profileView, $content);
    }

    /**
     * @param bool $renderAjax
     * @return string
     */
    public function actionViewDetail(bool $renderAjax = false): string
    {
        Yii::$app->view->title = 'View Detail';
        $user_id = Yii::$app->user->identity->id;
        $user = User::findOne(['id' => $user_id]);
        $user_detail = UserDetail::findOne(['user_id' => $user_id]);
        $user_address = UserAddress::findOne(['user_id' => $user_id]);
        $content = [
            'view_name' => 'view-detail',
            'user_address' => $user_address,
            'user_detail' => $user_detail,
            'user' => $user
        ];

        if ($renderAjax) {
            return $this->renderAjax($this->profileView, $content);
        }
        return $this->render($this->profileView, $content);
    }

    /**
     * @return string|void
     */
    public function actionChatDistanceCreate()
    {
        $request = Yii::$app->request;
        $model = new UserChatDistance();

        if ($request->isAjax){
            if ($model->load(Yii::$app->request->post())){
                $model->user_id = Yii::$app->user->identity->id;
                $model->save();
                return $this->actionChatDistance(true);
            }
        }
    }

    /**
     * @param $id
     * @return string
     * @throws StaleObjectException
     */
    public function actionChatDistanceDelete($id): string
    {
        $request = Yii::$app->request;
        if ($request->isAjax){
            if (($model = UserChatDistance::findOne($id)) !== null) {
                if ($model->delete()) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return $this->actionChatDistance(true);
                }
            }
        }
        return false;
    }

    /**
     * Logs in a user.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('index');
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout(): string
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return Response|string
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return Response|string
     * @throws BadRequestHttpException
     */
    public function actionResetPassword(string $token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     *@throws BadRequestHttpException
     */
    public function actionVerifyEmail(string $token): Response
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     * @return Response|string
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
