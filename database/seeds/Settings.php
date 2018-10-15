<?php

namespace Database\Seeds;

use App\Models\Common\Company;
use App\Models\Model;
use Illuminate\Database\Seeder;
use Setting;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->create();

        Model::reguard();
    }

    private function create()
    {
		$company_id = $this->command->argument('company');

        Setting::set([
            'general.date_format'               => 'd M Y',
            'general.date_separator'            => 'space',
            'general.timezone'                  => 'Europe/London',
            'general.percent_position'          => 'after',
            'general.invoice_number_prefix'     => 'INV-',
            'general.invoice_number_digit'      => '5',
            'general.invoice_number_next'       => '1',
            'general.default_payment_method'    => 'offlinepayment.cash.1',
            'general.email_protocol'            => 'mail',
            'general.email_sendmail_path'       => '/usr/sbin/sendmail -bs',
            'general.send_invoice_reminder'     => '0',
            'general.schedule_invoice_days'     => '1,3,5,10',
            'general.send_bill_reminder'        => '0',
            'general.schedule_bill_days'        => '10,5,3,1',
            'general.schedule_time'             => '09:00',
            'general.admin_theme'               => 'skin-green-light',
            'general.list_limit'                => '25',
            'general.use_gravatar'              => '0',
            'general.session_handler'           => 'file',
            'general.session_lifetime'          => '30',
            'general.file_size'                 => '2',
            'general.file_types'                => 'pdf,jpeg,jpg,png',
            'offlinepayment.methods'           => '[{"code":"offlinepayment.cash.1","name":"Cash","order":"1","description":null},{"code":"offlinepayment.bank_transfer.2","name":"Bank Transfer","order":"2","description":null}]',
        ]);
    }
}
