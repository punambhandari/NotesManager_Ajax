<?php

class Note extends CI_Model{

function get_all()
{

	return $this->db->query("select * from notes")->result_array();
}

function create($data)
{

	return $this->db->query("INSERT INTO notes (title,description,created_at) values(?,?,NOW())",
		array($data['title'],$data['description']));
}

function destroy($id)
{
	return $this->db->query("DELETE from notes where id=?",array($id));
}


function get($id)
{
	return $this->db->query("SELECT * from notes where id=?",array($id))->row_array();
}

function update($data)
{
	return $this->db->query("UPDATE notes set title=?,description=? where id=?",array($data['title'],$data['description'],$data['notes_id']));
}


}




?>