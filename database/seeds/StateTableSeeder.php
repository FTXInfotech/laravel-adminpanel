<?php

use Carbon\Carbon as Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CountryTableSeeder.
 */
class StateTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.states_table'));

        $states = [
            ['country_id' => 1, 'state' => 'Alaska', 'state_code' => 'AK', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Alabama', 'state_code' => 'AL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'American Samoa', 'state_code' => 'AS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Arizona', 'state_code' => 'AZ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Arkansas', 'state_code' => 'AR', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'California', 'state_code' => 'CA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Colorado', 'state_code' => 'CO', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Connecticut', 'state_code' => 'CT', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Delaware', 'state_code' => 'DE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'District of Columbia', 'state_code' => 'DC', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Federated States of Micronesia', 'state_code' => 'FM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Florida', 'state_code' => 'FL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Georgia', 'state_code' => 'GA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Guam', 'state_code' => 'GU', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Hawaii', 'state_code' => 'HI', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Idaho', 'state_code' => 'ID', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Illinois', 'state_code' => 'IL', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Indiana', 'state_code' => 'IN', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Iowa', 'state_code' => 'IA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Kansas', 'state_code' => 'KS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Kentucky', 'state_code' => 'KY', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Louisiana', 'state_code' => 'LA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Maine', 'state_code' => 'ME', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Marshall Islands', 'state_code' => 'MH', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Maryland', 'state_code' => 'MD', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Massachusetts', 'state_code' => 'MA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Michigan', 'state_code' => 'MI', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Minnesota', 'state_code' => 'MN', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Mississippi', 'state_code' => 'MS', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Missouri', 'state_code' => 'MO', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Montana', 'state_code' => 'MT', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Nebraska', 'state_code' => 'NE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Nevada', 'state_code' => 'NV', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'New Hampshire', 'state_code' => 'NH', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'New Jersey', 'state_code' => 'NJ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'New Mexico', 'state_code' => 'NM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'New York', 'state_code' => 'NY', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'North Carolina', 'state_code' => 'NC', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'North Dakota', 'state_code' => 'ND', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Northern Mariana Islands', 'state_code' => 'MP', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Ohio', 'state_code' => 'OH', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Oklahoma', 'state_code' => 'OK', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Oregon', 'state_code' => 'OR', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Palau', 'state_code' => 'PW', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Pennsylvania', 'state_code' => 'PA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Puerto Rico', 'state_code' => 'PR', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Rhode Island', 'state_code' => 'RI', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'South Carolina', 'state_code' => 'SC', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'South Dakota', 'state_code' => 'SD', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Tennessee', 'state_code' => 'TN', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Texas', 'state_code' => 'TX', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Utah', 'state_code' => 'UT', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Vermont', 'state_code' => 'VT', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Virgin Islands', 'state_code' => 'VI', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Virginia', 'state_code' => 'VA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Washington', 'state_code' => 'WA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'West Virginia', 'state_code' => 'WV', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Wisconsin', 'state_code' => 'WI', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Wyoming', 'state_code' => 'WY', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Armed Forces Africa', 'state_code' => 'AE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Armed Forces Americas (except Canada)', 'state_code' => 'AA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Armed Forces Canada', 'state_code' => 'AE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Armed Forces Europe', 'state_code' => 'AE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Armed Forces Middle East', 'state_code' => 'AE', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['country_id' => 1, 'state' => 'Armed Forces Pacific', 'state_code' => 'AP', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table(config('access.states_table'))->insert($states);

        $this->enableForeignKeys();
    }
}
