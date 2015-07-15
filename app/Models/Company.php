<?php namespace App\Models;

use DB;
use App\Presenters\PresentableTrait;

/**
 * Company
 *
 * @author Victor Lantigua <vmlantigua@gmail.com>
 */
class Company extends Base {

    use PresentableTrait;

    protected $presenter = 'App\Presenters\Company';

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'corp_code',
        'email',
        'phone',
        'fax'
    ];

    /**
     * Gets the address relation.
     *
     * @return Address
     */
    public function address()
    {
        return $this->hasOne('App\Models\Address');
    }

    /**
     * Checks if a logo has been uploaded.
     *
     * @param  string  $size  sm|md|lg
     * @return bool
     */
    public function hasLogo($size)
    {
        $path = 'uploads/companies/' . $this->id . '/images/logo/' . $size . '.png';

        return file_exists(public_path() . '/' . $path);
    }

    /**
     * Gets the logo URL.
     *
     * @param  string  $size  sm|md|lg
     * @return string
     */
    public function getLogoURL($size = 'sm')
    {
        $path = 'uploads/companies/' . $this->id . '/images/logo/' . $size . '.png';

        if (file_exists(public_path() . '/' . $path))
        {
            return asset($path) . '?cb=' . time();
        }

        return asset('assets/admin/img/avatar.png');
    }
}
