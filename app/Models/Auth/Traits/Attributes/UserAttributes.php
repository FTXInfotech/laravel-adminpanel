<?php

namespace App\Models\Auth\Traits\Attributes;

use Illuminate\Support\Facades\Hash;

trait UserAttributes
{
    /**
     * @param $password
     */
    public function setPasswordAttribute($password): void
    {
        // If password was accidentally passed in already hashed, try not to double hash it
        if (
            (\strlen($password) === 60 && preg_match('/^\$2y\$/', $password)) ||
            (\strlen($password) === 95 && preg_match('/^\$argon2i\$/', $password))
        ) {
            $hash = $password;
        } else {
            $hash = Hash::make($password);
        }

        // Note: Password Histories are logged from the \App\Observer\User\UserObserver class
        $this->attributes['password'] = $hash;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->last_name
            ? $this->first_name.' '.$this->last_name
            : $this->first_name;
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getPictureAttribute()
    {
        return $this->getPicture();
    }

    /**
     * @return string
     */
    public function getRolesLabelAttribute()
    {
        $roles = $this->roles->pluck('name')->map(function ($name) {
            return ucfirst($name);
        })->toArray();

        return ($roles) ? $roles : 'N/A';
    }

    /**
     * @return string
     */
    public function getPermissionsLabelAttribute()
    {
        $permissions = $this->getDirectPermissions()->toArray();

        if (\count($permissions)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item['name']);
            }, $permissions));
        }

        return 'N/A';
    }

    /**
     * @return string
     */
    public function getConfirmedLabelAttribute()
    {
        if ($this->isConfirmed()) {
            return "<label class='label label-success'>".trans('labels.general.yes').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.no').'</label>';
    }

    /**
     * @return string
     */
    public function getLoginAsButtonAttribute($class)
    {
        $name = $class == '' ? 'Login As' : '';
        // If the admin is currently NOT spoofing a user
        if (access()->allow('login-as-user') && (! session()->has('admin_user_id') || ! session()->has('temp_user_id'))) {
            //Won't break, but don't let them "Login As" themselves
            if ($this->id != auth()->user()->id) {
                return '<a class="'.$class.'" href="'.route(
                    'admin.auth.user.login-as',
                    $this
                ).'"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="'.trans(
                    'buttons.backend.auth.users.login_as',
                    ['user' => $this->name]
                ).'"></i>'.$name.'</a>';
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute($class)
    {
        if ($this->id != access()->id() && access()->allow('delete-user')) {
            $name = $class == '' ? trans('buttons.general.crud.delete') : '';

            return '<a class="'.$class.'" href="'.route('admin.auth.user.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i>'.$name.'</a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute($class)
    {
        if (access()->allow('show-user')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" href="'.route('admin.auth.user.show', $this).'" title="'.trans('buttons.general.crud.view').'"> 
                    <i class="fa fa-eye"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute($class)
    {
        if (access()->allow('edit-user')) {
            return '<a class="'.$class.'" data-toggle="tooltip" data-placement="top" href="'.route('admin.auth.user.edit', $this).'" title="'.trans('buttons.general.crud.edit').'">
                    <i class="fas fa-edit"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getChangePasswordButtonAttribute($class)
    {
        if (access()->user()->isAdmin() || (access()->user()->id == $this->id)) {
            return '<a class="'.$class.'" href="'.route('admin.auth.user.change-password', $this).'">
                        <i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.change_password').'">
                        </i>
                    </a>';
        }
    }

    /**
     * @return string
     */
    public function getStatusButtonAttribute($class)
    {
        if ($this->id != access()->id()) {
            switch ($this->status) {
                case 0:
                    if (access()->allow('activate-user')) {
                        $name = $class == '' ? trans('buttons.backend.access.users.activate') : '';

                        return '<a class="'.$class.'" href="'.route('admin.auth.user.mark', [$this, 1]).'"><i class="fa fa-check-square" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.activate').'"></i>'.$name.'</a>';
                    }

                    break;
                case 1:
                    if (access()->allow('deactivate-user')) {
                        $name = ($class == '') ? trans('buttons.backend.access.users.deactivate') : '';

                        return '<a class="'.$class.'" href="'.route('admin.auth.user.mark', [$this, 0]).'"><i class="fa fa-square" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.deactivate').'"></i>'.$name.'</a>';
                    }

                    break;
                default:
                    return '';
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getConfirmedButtonAttribute($class)
    {
        if (! $this->isConfirmed() && access()->allow('edit-user')) {
            return '<a class="'.$class.'" href="'.route('admin.access.user.account.confirm.resend', $this).'"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title='.trans('buttons.backend.access.users.resend_email').'"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getClearSessionButtonAttribute($class)
    {
        $name = $class == '' ? 'Clear Session' : '';

        if ($this->id != auth()->user()->id && config('session.driver') == 'database' && access()->allow('clear-user-session')) {
            return '<div class="btn-group btn-group-sm" role="group">'.
                '<button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.
                trans('labels.general.more').
                '</button>'.
                '<ul class="dropdown-menu" aria-labelledby="userActions">'.
                '<a href="'.route('admin.auth.user.clear-session', $this).'"
                            data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                            data-trans-button-confirm="'.trans('buttons.general.continue').'"
                            data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                            class="dropdown-item" name="confirm_item">'.trans('buttons.backend.access.users.clear_session').'</a>'.
                '</ul>'.
                '</div>';
        }

        return '';
    }

    public function checkAdmin()
    {
        $str = '';

        if ($this->id != 1) {
            $str .= '<div class="btn-group">
                        <button type="button" class="btn btn-warning btn-flat dropdown-toggle btn-sm" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-option-vertical"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                        <li>'.$this->getStatusButtonAttribute('').'</li>
                        <li>'.$this->getClearSessionButtonAttribute('').'</li>
                        <li>'.$this->getDeleteButtonAttribute('').'</li>
                        
                        </ul>
                    </div>';

            $str .= '';
            // <li>' . $this->getLoginAsButtonAttribute('') . '</li>
        }

        return $str;
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute($class)
    {
        if (access()->allow('delete-user')) {
            return '<a class="'.$class.'" href="'.route('admin.auth.user.restore', $this).'"
            data-method="post"
            data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
            data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
            ><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.restore_user').'"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute($class)
    {
        return '<a class="'.$class.'" href="'.route('admin.auth.user.delete-permanently', $this).'" 
        data-method="delete" 
        data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
        data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
        ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '<div class="btn-group action-btn">
                        '.$this->getRestoreButtonAttribute('btn btn-primary btn-sm').'
                        '.$this->getDeletePermanentlyButtonAttribute('btn btn-danger btn-sm').'
                    </div>';
        }

        // Check if role have all permission
        if (access()->user()->roles[0]->all) {
            return '<div class="btn-group" role="group" aria-label="'.trans('labels.backend.access.users.user_actions').'">
                    '.$this->getShowButtonAttribute('btn btn-success btn-sm').'
                    '.$this->getEditButtonAttribute('btn btn-primary btn-sm').'
                    '.$this->getChangePasswordButtonAttribute('btn btn-secondary btn-sm').'
                    '.$this->checkAdmin().'    
                </div>';
        }
        $userPermission = $this->getUserPermission();
        $permissionCounter = count($userPermission);
        $actionButton = '<div class="btn-group action-btn">';
        $i = 1;

        if (access()->user()->id == $this->id) {
            if (in_array('clear-user-session', $userPermission)) {
                $permissionCounter = $permissionCounter - 1;
            }

            if (in_array('login-as-user', $userPermission)) {
                $permissionCounter = $permissionCounter - 1;
            }

            if (in_array('delete-user', $userPermission)) {
                $permissionCounter = $permissionCounter - 1;
            }

            if (in_array('deactivate-user', $userPermission)) {
                $permissionCounter = $permissionCounter - 1;
            }
        }

        foreach ($userPermission as $value) {
            if ($i != 3) {
                $actionButton = $actionButton.''.$this->getActionButtonsByPermissionName($value, $i);
            }

            if ($i == 3) {
                $actionButton = $actionButton.''.$this->getActionButtonsByPermissionName($value, $i);

                if ($permissionCounter > 3) {
                    $actionButton = $actionButton.'
                            <div class="btn-group dropup">
                            <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-option-vertical"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">';
                }
            }
            $i++;
        }
        $actionButton .= '</ul></div></div>';

        return $actionButton;
    }
}
