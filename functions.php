<?php
$conn = mysqli_connect("localhost", "root", "", "db_penjualan");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function add($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama_pembeli"]);
    $hp = htmlspecialchars($data["hp"]);
    $id_barang = htmlspecialchars($data["id_barang"]);
    $kuantitas = htmlspecialchars($data["jumlah"]);
    $harga = htmlspecialchars($data["harga"]);
    $jenisbarang = htmlspecialchars($data["jenis_barang"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $tgl_transaksi = date('Y-m-d');
    
    $query = "INSERT INTO rusialdi
                VALUES
               ('', '$nama', '$alamat', '$hp', '$jenisbarang', '$id_barang', '$harga', '$kuantitas', '$tgl_transaksi')"; 
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deletes($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM rusialdi WHERE id_nama = $id");

    return mysqli_affected_rows($conn);
}

function edit($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama_pembeli"]);
    $hp = htmlspecialchars($data["hp"]);
    $id_barang = htmlspecialchars($data["id_barang"]);
    $kuantitas = htmlspecialchars($data["jumlah"]);
    $harga = htmlspecialchars($data["harga"]);
    $jenisbarang = htmlspecialchars($data["jenis_barang"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $tgl_transaksi = date('Y-m-d');
    
    $query = "UPDATE rusialdi SET
               nama = '$nama',
               alamat = '$alamat',
               hp = '$hp',
               jenis_barang = '$jenisbarang',
               id_barang = '$id_barang',
               harga = '$harga',
               jumlah = '$kuantitas',
               tgl_transaksi = '$tgl_transaksi'
               WHERE id_nama = $id"; 

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function find($keyword) {
    $query = "SELECT id_nama, nama, alamat, hp, jenis_barang, barang.id_barang, nama_barang, harga, jumlah, harga*jumlah as total FROM rusialdi INNER JOIN barang on rusialdi.id_barang=barang.id_barang
                WHERE
                nama_barang LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                id_nama LIKE '%$keyword%'";
                
    return query($query);
}

function regist($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]); // to make user possible add some string
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // does username exist
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'" );

    if( mysqli_fetch_assoc($result) ) {
        echo "
            <script>
                alert('Username already exist!')
                document.location.href = 'regist.php'
            </script>
       "; 
       return false;
    }

    // check confirm of the password
    if( $password !== $password2 ) {
        echo "
            <script>
                alert('Password do not match!')
                document.location.href = 'regist.php'
            </script>
       "; 
       return false;
    }

    // encrypt the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // add password to db
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

?>