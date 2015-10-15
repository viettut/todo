<?php

namespace Viettut\Bundles\UserSystem\AdminBundle;

final class ViettutUserSystemAdminEvents
{
    const CHANGE_PASSWORD_INITIALIZE = 'viettut_user_system_admin.change_password.edit.initialize';
    const CHANGE_PASSWORD_SUCCESS = 'viettut_user_system_admin.change_password.edit.success';
    const CHANGE_PASSWORD_COMPLETED = 'viettut_user_system_admin.change_password.edit.completed';
    const GROUP_CREATE_INITIALIZE = 'viettut_user_system_admin.group.create.initialize';
    const GROUP_CREATE_SUCCESS = 'viettut_user_system_admin.group.create.success';
    const GROUP_CREATE_COMPLETED = 'viettut_user_system_admin.group.create.completed';
    const GROUP_DELETE_COMPLETED = 'viettut_user_system_admin.group.delete.completed';
    const GROUP_EDIT_INITIALIZE = 'viettut_user_system_admin.group.edit.initialize';
    const GROUP_EDIT_SUCCESS = 'viettut_user_system_admin.group.edit.success';
    const GROUP_EDIT_COMPLETED = 'viettut_user_system_admin.group.edit.completed';
    const PROFILE_EDIT_INITIALIZE = 'viettut_user_system_admin.profile.edit.initialize';
    const PROFILE_EDIT_SUCCESS = 'viettut_user_system_admin.profile.edit.success';
    const PROFILE_EDIT_COMPLETED = 'viettut_user_system_admin.profile.edit.completed';
    const REGISTRATION_INITIALIZE = 'viettut_user_system_admin.registration.initialize';
    const REGISTRATION_SUCCESS = 'viettut_user_system_admin.registration.success';
    const REGISTRATION_COMPLETED = 'viettut_user_system_admin.registration.completed';
    const REGISTRATION_CONFIRM = 'viettut_user_system_admin.registration.confirm';
    const REGISTRATION_CONFIRMED = 'viettut_user_system_admin.registration.confirmed';
    const RESETTING_RESET_INITIALIZE = 'viettut_user_system_admin.resetting.reset.initialize';
    const RESETTING_RESET_SUCCESS = 'viettut_user_system_admin.resetting.reset.success';
    const RESETTING_RESET_COMPLETED = 'viettut_user_system_admin.resetting.reset.completed';
    const SECURITY_IMPLICIT_LOGIN = 'viettut_user_system_admin.security.implicit_login';
}
