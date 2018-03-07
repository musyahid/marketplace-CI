<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
  public $table = 'kategori';
  public $id    = 'id_kategori';
  public $order = 'DESC';

  // get all
  function get_all()
  {
    return $this->db->get($this->table)->result();
  }

  public function ambil_kategori()
  {
  	$sql_prov=$this->db->get('kategori');
  	if($sql_prov->num_rows()>0)
    {
  		foreach ($sql_prov->result_array() as $row)
			{
				$result['']= '- Pilih Kategori -';
				$result[$row['id_kategori']]= ucwords(strtolower($row['judul_kategori']));
			}
			return $result;
		}
	}

  public function ambil_subkat($kat)
  {
    $this->db->where('id_kat',$kat);
  	// $this->db->order_by('judul_subkat','asc');
  	$sql_subkat=$this->db->get('subkategori');
  	if($sql_subkat->num_rows()>0)
    {
  		foreach ($sql_subkat->result_array() as $row)
      {
        $result[$row['id_subkategori']]= ucwords(strtolower($row['judul_subkategori']));
      }
      return $result;
    }
	}

  public function ambil_supersubkat($subkat)
  {
    $this->db->where('id_subkat',$subkat);
  	// $this->db->order_by('judul_subkat','asc');
  	$sql_supersubkat=$this->db->get('supersubkategori');
  	if($sql_supersubkat->num_rows()>0)
    {
  		foreach ($sql_supersubkat->result_array() as $row)
      {
        $result[$row['id_supersubkategori']]= ucwords(strtolower($row['judul_supersubkategori']));
      }
      return $result;
    }
  }

  public function ambil_subkategori($kat_id)
  {
  	$this->db->where('id_kat',$kat_id);
  	$this->db->order_by('judul_subkategori','asc');
  	$sql=$this->db->get('subkategori');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_subkategori']]= ucwords(strtolower($row['judul_subkategori']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SubKategori -';
		}
    return $result;
	}

  public function ambil_supersubkategori($subkat_id)
  {
  	$this->db->where('id_subkat',$subkat_id);

  	$sql=$this->db->get('supersubkategori');
  	if($sql->num_rows()>0)
    {
  		foreach ($sql->result_array() as $row)
      {
        $result[$row['id_supersubkategori']]= ucwords(strtolower($row['judul_supersubkategori']));
      }
    }
    else
    {
		  $result['-']= '- Belum Ada SuperSubKategori -';
		}
    return $result;
	}

  function get_all_new_home()
  {
    $this->db->limit(4);
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  function get_all_kategori_sidebar()
  {
    $this->db->order_by('judul_kategori', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_total_row_kategori()
  {
    return $this->db->get($this->table)->count_all_results();
  }

  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row();
  }

  function get_by_id_front($id)
  {
    $this->db->from('produk');
    $this->db->where('subkat_seo', $id);
    $this->db->join('subkategori', 'produk.subkat_id = subkategori.id_subkat');
    return $this->db->get();
  }

  function get_list_by_kategori($slug, $limit=null, $offset=null)
  {
    $this->db->join('kategori', 'produk.kat_id=kategori.id_kategori');
    $this->db->join('users', 'produk.uploader = users.id');
    $this->db->where('kategori.slug_kat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_kategori_nr($slug)
  {
    $this->db->join('kategori', 'produk.kat_id=kategori.id_kategori');
    $this->db->join('users', 'produk.uploader = users.id');
    $this->db->where('kategori.slug_kat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_list_by_subkategori($slug, $limit=null, $offset=null)
  {
    $this->db->join('subkategori', 'produk.subkat_id=subkategori.id_subkategori');
    $this->db->join('users', 'produk.uploader = users.id');
    $this->db->where('subkategori.slug_subkat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_subkategori_nr($slug)
  {
    $this->db->join('subkategori', 'produk.subkat_id=subkategori.id_subkategori');
    $this->db->join('users', 'produk.uploader = users.id');
    $this->db->where('subkategori.slug_subkat', $slug);

    return $this->db->get('produk')->num_rows();
  }

  function get_list_by_superskategori($slug, $limit=null, $offset=null)
  {
    $this->db->join('supersubkategori', 'produk.supersubkat_id=supersubkategori.id_supersubkategori');
    $this->db->join('users', 'produk.uploader = users.id');
    $this->db->where('supersubkategori.slug_supersubkat', $slug);
    $this->db->limit($limit, $offset);

    return $this->db->get('produk');
  }

  function get_by_superskategori_nr($slug)
  {
    $this->db->join('supersubkategori', 'produk.supersubkat_id=supersubkategori.id_supersubkategori');
    $this->db->join('users', 'produk.uploader = users.id');
    $this->db->where('supersubkategori.slug_supersubkat', $slug);

    return $this->db->get('produk')->num_rows();
  }
  
  // get total rows
  function total_rows()
  {
    return $this->db->get($this->table)->num_rows();
  }

  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  function update($id, $data)
  {
    $this->db->where($this->id,$id);
    $this->db->update($this->table, $data);
  }

  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

}

/* End of file Kategori_model.php */
/* Location: ./application/models/Kategori_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */
