<?php

interface Subscription
{
    public function price();

    public function description();
}

class BasicSubscription implements Subscription
{
    public function price()
    {
        return 5;
    }

    public function description()
    {
        return 'BasicSubscription';
    }
}

abstract class SubscriptionFeature implements Subscription
{
    protected $subscription;

    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    abstract public function price();

    abstract public function description();
}

class AdditionalSpaceFeature extends SubscriptionFeature
{


    public function price()
    {
        return $this->subscription->price() + 3;
    }

    public function description()
    {
        return $this->subscription->description() . ' + AdditionalSpace';
    }
}

class  SupportFeature extends SubscriptionFeature
{
    public function price()
    {
        return $this->subscription->price() + 1;
    }

    public function description()
    {
        return $this->subscription->description() . ' + support';
    }
}

$subscription = new SupportFeature(new BasicSubscription());

echo $subscription->price();
echo $subscription->description();