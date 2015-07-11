<?php namespace App\Models;

use App\Presenters\PresentableTrait;
use Auth;

/**
 * Carrier
 *
 * @author Victor Lantigua <vmlantigua@gmail.com>
 */
class Carrier extends Base {

    use PresentableTrait;

    protected $presenter = 'App\Presenters\Carrier';

    protected $table = 'carriers';

    public static $rules = [
        'name' => 'required',
    ];

    protected $fillable = [
        'name',
        'created_by_user_id'
    ];

    /**
     * Overrides parent method to assign created_by_user_id.
     *
     * @see parent::save()
     */
    public function save(array $options = array())
    {
        if ( ! $this->exists) {
            $this->created_by_user_id = Auth::user()->id;
        }
        parent::save($options);
    }

    /**
     * Retrieves a list of carriers for a jquery autocomplete field.
     *
     * @param  string $keyword     A search query
     * @return User[]
     */
    public static function autocompleteSearch($keyword)
    {
        $keyword = '%' . $keyword . '%';
        $where = '(id LIKE ? OR name LIKE ?)';
        return Carrier::whereRaw($where, [$keyword, $keyword])->get();
    }

    /**
     * Overrides parent method to sanitize certain attributes.
     *
     * @see parent::setAttribute()
     */
    public function setAttribute($key, $value)
    {
        switch ($key) {
            case 'name':
                $value = $this->sanitizeName($value);
                break;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Sanitizes a carrier name in preparation for database.
     *
     * @param  string $name
     * @return string
     */
    private function sanitizeName($name)
    {
        // Strip all non-alpha characters except for spaces
        $name = preg_replace('/[^a-z ]/i', '', $name);
        // Strip consecutive spaces
        $name = preg_replace('/\s+/S', ' ', $name);
        // Trim and uppercase
        $name = strtoupper(trim($name));
        return $name;
    }
}
