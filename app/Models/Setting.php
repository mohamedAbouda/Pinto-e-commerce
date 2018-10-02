<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $connection = 'mysql';
    protected $fillable = [
        'site_name','site_domain','logo','currency','description','facebook_pixel_base_code'
        ,'facebook_pixel_event_code','google_analytics',
        'contact_us_phone' , 'contact_us_address' , 'contact_us_description' ,
        'contact_us_coordinates','visits_counter','contact_email' , 'fb_link' , 'tw_link' , 'pin_link' ,
        'tu_link' ,'gp_link','hotline','web_menu',
        'paypal_client_id','paypal_client_secret',
        'payfort_secret_key','payfort_open_key','payfort_currency','payfort_customer_email'
        ,'theme','footer_text_under_logo','footer_address','footer_email','footer_phone'
        ,'footer_rights'
    ];

    protected $hidden = [
        'created_at' , 'updated_at'
    ];

    protected $_upload_path;

    public function __construct(array $input = []){
        parent::__construct($input);
        $this->_upload_path = 'images/setting';
    }

    /**
    * Overrides
    */

    public static function create(array $input = [])
    {
        $resource = new self($input);

        if (isset($input['logo']) && $input['logo']) {
            $resource->logo  = $input['logo']->store($resource->_upload_path);
        }else{
            $input['logo'] = '';
        }

        $saved =  $resource->save();
        return ($saved)?$resource:NULL;
    }
    public function patch(array $input = [])
    {
        if (isset($input['logo']) && $input['logo']) {
            $path_to_file = storage_path('app/'.$this->logo);
            if ($this->logo && file_exists($path_to_file)) {
                unlink($path_to_file);
            }
            $input['logo']  = $input['logo']->store($this->_upload_path);
        }
        $state = $this->update($input);
        return $state;
    }
}
