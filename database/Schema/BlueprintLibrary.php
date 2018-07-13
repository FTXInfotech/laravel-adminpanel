<?php

namespace Database\Schema;

use Illuminate\Database\Schema\Blueprint;

class BlueprintLibrary extends Blueprint
{
    /**
     * Add created and updated by, created and updated at,  deleted at and
     * status field.
     *
     * @param array $columns
     *
     * @return void
     */
    public function defaultColumns($columns = ['all'])
    {
        if (in_array('all', $columns) || in_array('status', $columns)) {
            $this->tinyInteger('status')->default(1)->unsigned();
        }

        if (in_array('all', $columns) || in_array('created_by', $columns)) {
            $this->integer('created_by')->unsigned();
        }

        if (in_array('all', $columns) || in_array('updated_by', $columns)) {
            $this->integer('updated_by')->unsigned()->nullable();
        }

        if (in_array('all', $columns) || in_array('created_at', $columns)) {
            $this->timestamp('created_at')->nullable();
        }

        if (in_array('all', $columns) || in_array('updated_at', $columns)) {
            $this->timestamp('updated_at')->nullable();
        }

        if (in_array('all', $columns) || in_array('deleted_at', $columns)) {
            $this->timestamp('deleted_at')->nullable();
        }
    }

    /**
     * Drop created and updated by, created and updated at,  deleted at and
     * status field.
     *
     * @param array $columns
     *
     * @return void
     */
    public function dropDefaultColumns($columns = ['all'])
    {
        if (in_array('all', $columns) || in_array('status', $columns)) {
            $this->dropColumn('status');
        }

        if (in_array('all', $columns) || in_array('created_by', $columns)) {
            $this->dropColumn('created_by');
        }

        if (in_array('all', $columns) || in_array('updated_by', $columns)) {
            $this->dropColumn('updated_by');
        }

        if (in_array('all', $columns) || in_array('created_at', $columns)) {
            $this->dropColumn('created_at');
        }

        if (in_array('all', $columns) || in_array('updated_at', $columns)) {
            $this->dropColumn('updated_at');
        }

        if (in_array('all', $columns) || in_array('deleted_at', $columns)) {
            $this->dropColumn('deleted_at');
        }
    }
}
