<?php

return [

    /**
     * Here you can define where to route for and after the verification.
     * If you like to you can manually set the routes in there published folder
     */
    'route' => [
        // Published: App\Traits\Auth\MustVerifyNewEmail.php => verificationUrl()
        // Default: route('verification.verify')
        'for' => 'verification.verify',
        
        // Published: App\Http\Controllers\Auth\VerifyNewEmailController.php => __invoke()
        // Default: route('home')
        'after' => 'home',
    ],

    /**
     * Everytime a user set a new email address you can decide if the user looses
     * its email verification status or not. If set to true the user can't access
     * areas with middleware 'verified'.
     * 
     * Published: App\Traits\Auth\MustVerifyNewEmail.php => newEmail()
     * Default: true
     */
    'reset_verification' => true,

    /**
     * Here you can define how many minutes the verification url is active.
     * 
     * Published: App\Traits\Auth\MustVerifyNewEmail.php => verificationUrl()
     * Default: 60
     */
    'expire' => 60,
];
