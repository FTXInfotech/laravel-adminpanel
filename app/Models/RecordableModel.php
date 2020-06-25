<?php

namespace App\Models;

use Altek\Accountant\Contracts\Recordable;
use Altek\Accountant\Recordable as RecordableTrait;

/**
 * Class RecordingModel.
 */
abstract class RecordableModel extends BaseModel implements Recordable
{
    use RecordableTrait;
}
