<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $surname;

    /**
     * @var UploadedFile
     */
    public $avatar;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'surname'], 'filter', 'filter' => 'trim'],
            [['username', 'surname'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже занято.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['surname', 'string', 'min' => 2, 'max' => 120],

            [['avatar'], 'safe'],
            [['avatar'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес уже занят.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'surname' => 'Фамилия',
            'avatar' => 'Аватар',
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($this->avatar->error==UPLOAD_ERR_OK) {
                $strFileName = md5(uniqid('avatar') . '-' . $this->avatar->baseName) . '.' . $this->avatar->extension;
                $this->avatar->saveAs('uploads/' . $strFileName);
                $image = new \Imagick('uploads/' . $strFileName);
                $image->thumbnailImage(300, 0);
                $image->writeImage();
                $user->avatar = $strFileName;
            }
            $user->save();
            return $user;
        }

        return null;
    }
}
