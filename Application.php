<?php


namespace App\Core;
use App\Core\Db\Database;
use App\Core\Db\DbModel;

/**
 * Class Application
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Application
{
    /** Class Static Variables */
    public static string $ROOT_DIR;
    public static Application $app;

    /** Class Variables */
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?Controller $controller = null;
    public ?UserModel $user;
    public View $view;

    /**
     * Application constructor.
     *
     * @param $rootPath
     * @param array $config
     */
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = str_replace('\\', '/', $rootPath);
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->view = new View();

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    /**
     * App run method
     */
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * Get Controller
     *
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * Set Controller
     *
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    /**
     * isGuest func.
     * @return bool
     */
    public static function isGuest()
    {
        return !self::$app->user;
    }

    /**
     * Login func.
     * @param UserModel $user
     * @return bool
     */
    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $this->user->primaryKey();
        $primaryValue = $this->user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    /**
     * Logout func.
     */
    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}