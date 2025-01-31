<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SendProjectDetailsEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New TheVacationCalendar.com Next Week!!!')
            ->line(new HtmlString('<div style="background-color: rgb(234, 240, 246)"><img src="'.asset('logo/logo.jpg').'" alt="'. config('app.name') .'" style="padding: 20px" /></div>'))
            ->line(new HtmlString('<div><img src="'.asset('logo/Header.webp').'" alt="'. config('app.name') .'" style="padding: 20px" /></div>'))
            ->line(new HtmlString('<h1 style="text-align: center !important;font-weight: bold;font-size: 24px;">NEXT WEEK!!</h1>'))
            ->line(new HtmlString('<h1 style="text-align: center !important;font-weight: bold;font-size: 24px;">All new <a href="https://dev.devdimensions.com/">TheVacationCalendar.com</a> website!</h1>'))
            ->line(new HtmlString('</p>We are ready for launch!! I cant say this enough, the new site is VERY different than the old site. We have created a <a href="https://www.youtube.com/playlist?list=PLxQfh1gnJa77a5kzRzEXjhOGmsbLfHGO3" style="color: rgb(0, 164, 189)">YouTube channel with training videos</a> that will be available to you should you have questions on how to do things. The videos are two to five minutes long so you can quickly learn what you need.</p><br/><br/><br/><br/>'))
            ->line(new HtmlString('<p>The rollout plan is to take the site down late Sunday night, November 27th. We will do the migration and perform a final round of testing for the first few days of that week. If all goes well the new website will be available on Tuesday, but if we run into any hiccups it may take another couple of days to address those last minute items. We appreciate your patience with this rollout. We are SO excited about the new site and cant wait to let you try it out.</p><br/><br/><br/>'))
            ->line(new HtmlString('<p>We already have two more releases scheduled. The first will be a content release where we add a lot more helpful content to the site. We will also include links to the videos. I am hoping to get this content out quickly to help you with any issues you are having - so if you are having issues, just give it a week or so and then check back to review the documentation.</p><br/><br/><br/>'))
            ->line(new HtmlString('<p>The second release is going to continue to provide more functionality. We have a few tweaks with PayPal that we need to make and the "booking rooms" functionality is not where we want it. We have a plan and will implement it, but we figured we should get the functionality we have out into your hands, listen for feedback, and then incorporate your feedback into the next couple of releases.</p><br/>'))
            ->line(new HtmlString('<a href="https://www.youtube.com/watch?v=WdJx1ZdbTII&ab_channel=TheVacationCalendar" style="color: aliceblue;font-size: 16px;border-radius: 10px;text-align: center;text-decoration: none;
                  font-family: Arial, sans-serif;padding: 12px 18px;display: block;background: rgb(0, 164, 189);" type="button">See the New Site Here!</a><br />'))
            ->line(new HtmlString('<h1 style="font-weight: bold;font-size: 22px;">Free Training Videos!</h1>'))
            ->line(new HtmlString('<div style="margin: auto;text-align: center"><a href="https://www.youtube.com/watch?v=ZQNU5DuwZuw&ab_channel=TheVacationCalendar"><img src="'.asset('logo/video.jpg').'" alt="'. config('app.name') .'" style="padding: 20px" /></a></div>'))
            ->line(new HtmlString('<p style="justify-content: center; width: fit-content;margin: auto"><a href="https://www.youtube.com/playlist?list=PLxQfh1gnJa77a5kzRzEXjhOGmsbLfHGO3" style="color: aliceblue;font-size: 16px;border-radius: 10px;text-align: center;text-decoration: none;
                  font-family: Arial, sans-serif;padding: 12px 18px;display: block;background: rgb(0, 164, 189);" type="button">Take a look!</a></p><br />'))
            ->line(new HtmlString('<h1 style="font-weight: bold;font-size: 22px;">Social media:</h1><br />'))
            ->line(new HtmlString('<p style="text-align: center;">
                 <a href="https://www.facebook.com/thevacationcalendar?utm_medium=email&_hsmi=2&_hsenc=p2ANqtz-9oYAX6FRTXCaqU1iJie6-uUmLVvfOtpRc69Ki4Uq7sSB8G8qB-CRYd-FW6deXd2qBH7aJw2pZ76Rr0WPX0V0ZNSaUfMlo9UxoiSsmppkdR1g06gpQ&utm_content=2&utm_source=hs_email"><img src="'.asset('logo/facebook.png').'" alt="'. config('app.name') .'" /></a>
                 <a href="https://www.youtube.com/channel/UCXxQTnfwdvMX-Yb30X-WpYQ"><img src="'.asset('logo/youtube.png').'" alt="'. config('app.name') .'" /></a>
                 <a href="https://www.thevacationcalendar.com/?utm_medium=email&_hsmi=2&_hsenc=p2ANqtz-8BbN9IHerPIGHDYDxJeb-dXxy08B807-d1J1VuhFR62JTm-kwklKek-m4kACVJ2a1SsN063ecJ__PZSPxC7tPrOv1obizfiNmOOD_oIK9xernajME&utm_content=2&utm_source=hs_email"><img src="'.asset('logo/website_circle.png').'" alt="'. config('app.name') .'" /></a>
                 <a href="https://www.instagram.com/thevacationcalendar/?utm_medium=email&_hsmi=2&_hsenc=p2ANqtz-_Ycvhyp0WQFPwn80jw16QuhdpuTv8P1A-Qg9E2KwcKeLRoUKaducy0fmHcABmaqbtNywnIbciw03-9pxU0r7cCcEpa7r43SyquVIaNWNCNMjDjYPo&utm_content=2&utm_source=hs_email"><img src="'.asset('logo/instagram.png').'" alt="'. config('app.name') .'" /></a>
                 <a href="https://twitter.com/TheVacationCal?utm_medium=email&_hsmi=2&_hsenc=p2ANqtz--QDWVpHJlGoTVWT0slcynEZwRYynNE-MyACKKFO-y8uCd00W_VSg4oKv7xGzKoYetM6LzNj5GJAGXq983zo4oW06ltrOS22wLh2JjLLbkJDwJqxH8&utm_content=2&utm_source=hs_email"><img src="'.asset('logo/twitter.png').'" alt="'. config('app.name') .'" /></a>
                 </p><br />'))
            ->line(new HtmlString('<p>We would love your help promoting our site on social media. The more users we have the lower we can keep the cost for all of you. Follow, share, tweet, whatever. This is all new to us.</p><br/><br/>'))
            ->line(new HtmlString('<h1 style="font-weight: bold;font-size: 24px;">Should I upgrade my subscription?</h1><br />'))
            ->line(new HtmlString('<p>Not yet. Right now, you should sit tight on your existing $20 a year plan and just enjoy all the new features. Sometime in the future (late 2023 and into 2024) we will need everyone to subscribe to one of our new plans, but as our existing users, we just want you to enjoy the site at the same $20 a year price that we set back in 2006. On top of that, we are still working out the kinks of some of the newer features (like booking rooms) that we plan on charging a little more for.</p><br/><br/>'))

            ->line(new HtmlString('<div style="border-top:1px solid grey"></div><br /><br />'))

            ->line(new HtmlString('<p style="text-align: center;line-height: 0.1rem !important">Have questions? Either respond to this email or contact the sender on</p>'))
            ->line(new HtmlString('<p style="text-align: center;"><a href="mailto:youremail@example.com" rel="noopener" target="_blank" title="mailto:support@thevacationcalendar.com" style="color:rgb(0, 164, 189)">support@thevacationcalendar.com</a></p><br /><br /><br />'))
            ->line(new HtmlString('<p style="text-align: center;font-family: Arial, sans-serif; font-size: 12px; color: rgb(35, 73, 109);">TheVacationCalendar, 11269 Center Harbor Road, Reston, VA 20194, United States</p>'));
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
