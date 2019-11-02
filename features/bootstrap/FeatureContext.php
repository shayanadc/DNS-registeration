<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \Tests\TestCase implements Context
{
    protected $request;
    protected $response;
    protected $route;
    protected $header = [];
    protected $domain;
    protected $record;
    protected $email;
    use \Illuminate\Foundation\Testing\DatabaseMigrations;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        putenv("APP_ENV=testing");
        putenv("BCRYPT_ROUNDS=4");
        putenv("CACHE_DRIVER=array");
        putenv("DB_CONNECTION=sqlite_testing");
        putenv("DB_DATABASE=:memory:");
        putenv("MAIL_DRIVER=array");
        putenv("QUEUE_CONNECTION=sync");
        putenv("SESSION_DRIVER=array");
        parent::setUp();
    }

    /**
     * @Given a user
     */
    public function aUser()
    {
//        throw new PendingException();
    }

    /**
     * @When open :arg1 form
     */
    public function openForm($arg1)
    {
        $this->route = $arg1;
    }

    /**
     * @When fill the form with:
     */
    public function fillTheFormWith(PyStringNode $string)
    {
        $this->request = json_decode($string->getRaw(),true);
    }

    /**
     * @When submit the form
     */
    public function submitTheForm()
    {
        $this->response = $this->postJson($this->route, $this->request, $this->header);
    }

    /**
     * @Then receive ok
     */
    public function receiveOk()
    {
        $this->response->assertStatus(200);
    }

    /**
     * @Then receive JSON response:
     */
    public function receiveJsonResponse(PyStringNode $string)
    {
        $jsonResp = $string->getRaw();
        $this->assertJsonStringEqualsJsonString($jsonResp, $this->response->getContent());
    }

    /**
     * @Given a domain with name :arg1
     */
    public function aDomainWithName($arg1)
    {
        $this->domain = factory(\App\Domain::class)->create([
            'name' => $arg1
        ]);
    }

    /**
     * @When submit the page
     */
    public function submitThePage()
    {
        $this->response = $this->getJson($this->route);
    }
    /**
     * @Given a record with content :arg1
     */
    public function aRecordWithContent($arg1)
    {
        $this->record = factory(\App\RecordType::class)->create([
            'domain_id' => $this->domain->id,
            'content' => $arg1
        ]);
    }

    /**
     * @Given fake user token with :arg1
     */
    public function fakeUserTokenWith($arg1)
    {
        \App\Token::setTest($arg1);
    }

    /**
     * @Given user :email with password :password has already registered
     */
    public function userWithPasswordHasAlreadyRegistered($email, $password)
    {
        $this->email = $email;
        factory(\App\User::class)->create([
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
            'api_token' => \App\Token::generate()
        ]);
    }
}