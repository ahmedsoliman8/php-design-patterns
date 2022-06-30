<?php

interface Observer
{

    public function handle($event);
}

interface Subject
{

    public function attach(Observer $observer);

    public function detach(Observer $observer);

    public function notify();
}

trait Subjectable
{
    protected $observers = [];

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        for ($i = 0; $i < count($this->observers); $i++) {
            if ($this->observers[$i] == $observer) {
                unset($this->observers[$i]);
            }
            $this->observers = array_values($this->observers);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->handle($this);
        }
    }
}

class Login implements Subject
{
    use Subjectable;

   
}

class MailingListSignup implements Subject
{
    use  Subjectable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


}


class UpdateMailingStatusInDatabase implements Observer
{

    public function handle($event)
    {
        var_dump('Update Mailing Status In Database ' . $event->user->id);
    }
}

class  SubscriberUserToService implements Observer
{

    public function handle($event)
    {
        var_dump('Subscriber User To Service ' . $event->user->email);
    }
}


class  User
{
    public $id = 1;
    public $email = 'ahmed@gmail.com';
}


$user = new User();
$event = new  MailingListSignup($user);

$event->attach(new UpdateMailingStatusInDatabase());
$event->attach(new SubscriberUserToService());

$event->notify();

















