<?php

use App\Core\Database;

class Registration 
{
    private $table = 'registrations';
    private $db;

    public function __construct(Database $db = null)
    {
        if ($db === null) {
            $db = Database::getInstance();
        }
        $this->db = $db;
    }

    public function createRegistration(
        $user_id, 
        $nama, 
        $tempat_lahir, 
        $tanggal_lahir, 
        $jenis_kelamin, 
        $agama, 
        $alamat,
        $no_telepon
    )
    {
        $sql = "INSERT INTO $this->table (user_id, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat, no_telepon) VALUES (:user_id, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :agama, :alamat, :no_telepon)";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':nama', $nama);
        $this->db->bind(':tempat_lahir', $tempat_lahir);
        $this->db->bind(':tanggal_lahir', $tanggal_lahir);
        $this->db->bind(':jenis_kelamin', $jenis_kelamin);
        $this->db->bind(':agama', $agama);
        $this->db->bind(':alamat', $alamat);
        $this->db->bind(':no_telepon', $no_telepon);
        $this->db->execute();

        $sql = "UPDATE users SET registered = TRUE WHERE id = :user_id";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();

    }

    public function getAllRegistrations()
    {
        $sql = "SELECT * FROM $this->table";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function hasRegistered($user_id)
    {
        $sql = "SELECT COUNT(*) FROM $this->table WHERE user_id = :user_id";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        return $this->db->count();
    }

    public function getRegistrationByUserId($user_id)
    {
        $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function updateRegistrationStatus($id, $keterangan)
    {
        $sql = "UPDATE $this->table SET keterangan = :keterangan WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':keterangan', $keterangan);
        return $this->db->execute();
    }
}