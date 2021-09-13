<?php

namespace app\controllers;

use app\models\Cart;
use app\models\ClientGroup;
use app\models\Discount;
use app\models\Product;
use app\models\ProductCategory;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $discountToNewClientGroup = new Discount(5, TYPE_ABSOLUTE);
        $newClientsGroup = new ClientGroup('Nuevos clientes', $discountToNewClientGroup);
        $customer = new User(1,'alvaro', $newClientsGroup);

        $discountToCart = new Discount(10);
        $cart = new Cart($customer, $discountToCart);

        $officeDiscount = new Discount(30);
        $officeCategory = new ProductCategory('office', $officeDiscount);

        $chairDiscount = new Discount(0);
        $chairProduct = new Product(1, 'chair', 25, $officeCategory, $chairDiscount);

        $cart->addProduct($chairProduct);

        return $this->render('index', ['cart' => $cart]);
    }
}
