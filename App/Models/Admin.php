<?php
// app/models/Admin.php
class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'adminname',
        'email',
        'mypassword'
    ];

    protected $hidden = [
        'mypassword'
    ];

    public function createAdmin($data)
    {
        $data['mypassword'] = password_hash($data['mypassword'], PASSWORD_DEFAULT);
        $admin = new Admin($data);
        $admin->save();
        return $admin;
    }

    public function updateAdmin($id, $data)
    {
        $admin = Admin::find($id);
        if (isset($data['mypassword'])) {
            $data['mypassword'] = password_hash($data['mypassword'], PASSWORD_DEFAULT);
        }
        $admin->update($data);
        return $admin;
    }

    public function deleteAdmin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
    }

    public function getAllAdmins()
    {
        return Admin::all();
    }

    public function getAdminByEmail($email)
    {
        return Admin::where('email', $email)->first();
    }

    public function authenticate($email, $password)
    {
        $admin = $this->getAdminByEmail($email);
        if ($admin && password_verify($password, $admin->mypassword)) {
            return $admin;
        }
        return false;
    }
}