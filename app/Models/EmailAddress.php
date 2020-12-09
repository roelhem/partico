<?php

namespace App\Models;

use App\Models\Traits\BelongsToContact;
use App\Models\Traits\OrderableWithIndex;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class EmailAddress extends Model
{
    use HasFactory;
    use Userstamps;

    use BelongsToContact, OrderableWithIndex;

    // ---------------------------------------------------------------------------------------------------------- //
    // ----- MODEL CONFIGURATION -------------------------------------------------------------------------------- //
    // ---------------------------------------------------------------------------------------------------------- //

    protected $table = 'email_addresses';

    protected $fillable = ['label','email_address','options','remarks'];

    // ---------------------------------------------------------------------------------------------------------- //
    // ----- MAGIC METHODS -------------------------------------------------------------------------------------- //
    // ---------------------------------------------------------------------------------------------------------- //

    /**
     * Returns the email_address as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->email_address ?? '(onbekend)';
    }

    // ---------------------------------------------------------------------------------------------------------- //
    // ----- CUSTOM ACCESSORS ----------------------------------------------------------------------------------- //
    // ---------------------------------------------------------------------------------------------------------- //

    public function getWithNameAttribute() {
        return trim($this->contact->name) . ' <' . trim($this->email_address) . '>';
    }

    public function getLinkAttribute() {
        return 'mailto:'.urlencode($this->contact->name.' ') . '<'.trim($this->email_address).'>';
    }

}
