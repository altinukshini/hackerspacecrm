<?php

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->truncate();

        $templates = [
			[
				'title' => 'New account created',
				'slug' => 'newaccount',
				'description' => 'This email will be sent to users that are created via a site administrator under /users page',
				'email_subject' => 'New account created at '.crminfo('name'),
				'email_body' => 'Hi {{ $user->full_name }},
<br />
<br />
A new account has been created for you by a site administrator at <a href=\'{{ $crm->url }}\'>{{ $crm->crmname }}</a>.
<br />
<br />
Please use the following credentials to sign in:<br />
Username: <b>{{ $user->username }}</b><br />
Password: <b>{{ $password }}</b>
<br />
<br />
You may now sign in by visiting the following link: <a href=\'{{ $crm->url }}/login\'>{{ $crm->url }}/login</a>
<br />
<br />
Please change your password by visiting your edit account page: <a href=\'{{ $edit_link }}\'>{{ $edit_link }}</a><br />
or request a Password Reset Link at: <a href=\'{{ $reset_link }}\'>{{ $reset_link }}</a>
<br />
<br />
Happy hacking!<br />
{{ $crm->crmname }}',
				'syntax_help' => 'Required variables to be included: $reset_link, $edit_link, $password',
				'locale' => 'en'
			],
			[
				'title' => 'Email confirmation',
				'slug' => 'confirmation',
				'description' => 'This email will be sent to users who register via the the crm registration form.',
				'email_subject' => 'Email confirmation required',
				'email_body' => 'Thanks for signing up!
<br />
<br />
You are receiving this email because you have recently requested to create an account in {{ $crm->crmname }}.
<br />
<br />
Your username is <b>{{ $user->username }}</b>. To confirm your account and log in, please visit <a href=\'{{ $confirmation_link }}\'>{{ $confirmation_link }}</a>.
<br />
<br />
Happy hacking!<br />
{{ $crm->crmname }}',
				'syntax_help' => 'Required variables to be included: $confirmation_link',
				'locale' => 'en'
			],
		];

		foreach ($templates as $template) {
			EmailTemplate::create($template);
		}


    }
}
