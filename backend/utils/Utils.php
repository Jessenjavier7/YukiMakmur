<?php

class Utils
{
    public static function getConnection()
    {
        $conn = mysqli_connect("localhost", "root", "", "araStore");
        return $conn;
    }

    public static function getInventoryData($conn)
    {
        $sql = "SELECT i.*, v.name AS NamaVendor FROM inventory i,vendor v WHERE i.vendor_id = v.vendor_id
        ORDER BY i.name ASC";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNewestInventoryData($conn)
    {
        $sql = "SELECT * FROM inventory
        ORDER BY created_at DESC LIMIT 1";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaBarangInventoryData($conn)
    {
        $sql = "SELECT name FROM inventory";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInfoBarangInventoryDataBasedonNamaBarang($conn, $namaBarang)
    {
        $sql = "SELECT inventory_id, harga_colly, harga_dozen, harga_piece FROM inventory WHERE name = '$namaBarang'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInfoHargaCollyDozenPieceInventoryDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "SELECT harga_colly, harga_dozen, harga_piece FROM inventory WHERE inventory_id = '$inventory_id'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInfoCollyDozenPieceInventoryDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "SELECT colly, dozen, piece FROM inventory WHERE inventory_id = '$inventory_id'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getTotalStockInventory($conn)
    {
        $sql = "SELECT SUM(piece) AS total_stock FROM inventory";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInventoryDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "SELECT i.*, v.name AS NamaVendor FROM inventory i, vendor v WHERE i.vendor_id = v.vendor_id AND inventory_id = '$inventory_id'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahInventoryData($conn, $id_Barang, $id_Vendor, $nama_Barang, $colly, $dozen, $piece, $harga_colly, $harga_dozen, $harga_piece, $gambar_Barang, $created_at, $updated_at)
    {
        $sql = "INSERT INTO inventory (inventory_id, vendor_id, name, colly, dozen, piece, harga_colly, harga_dozen, harga_piece, picture, created_at, updated_at) VALUES ('$id_Barang', '$id_Vendor','$nama_Barang', '$colly', '$dozen', '$piece', '$harga_colly', '$harga_dozen', '$harga_piece', '$gambar_Barang', '$created_at', '$updated_at')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function editInventoryDataBasedonInventoryID($conn, $id_Barang, $id_Vendor, $nama_Barang, $colly, $dozen, $piece, $harga_colly, $harga_dozen, $harga_piece, $gambar_Barang)
    {
        $sql = "UPDATE inventory SET inventory_id = '$id_Barang', vendor_id = '$id_Vendor', name = '$nama_Barang', colly = '$colly', dozen = '$dozen', piece = '$piece', harga_colly ='$harga_colly', harga_dozen ='$harga_dozen', harga_piece ='$harga_piece', picture = '$gambar_Barang' WHERE inventory_id = '$id_Barang'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function editInventoryDataBasedonInventoryIDWithoutPicture($conn, $id_Barang, $id_Vendor, $nama_Barang, $colly, $dozen, $piece, $harga_colly, $harga_dozen, $harga_piece)
    {
        $sql = "UPDATE inventory SET inventory_id = '$id_Barang', vendor_id = '$id_Vendor', name = '$nama_Barang', colly = '$colly', dozen = '$dozen', piece = '$piece', harga_colly ='$harga_colly', harga_dozen ='$harga_dozen', harga_piece ='$harga_piece' WHERE inventory_id = '$id_Barang'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function deleteInventoryDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "DELETE FROM inventory WHERE inventory_id = '$inventory_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function liveSearchInventoryData($conn, $searchValue)
    {
        $sql = " SELECT i.*, v.name AS NamaVendor FROM inventory i 
        JOIN vendor v ON i.vendor_id = v.vendor_id 
        WHERE (i.name LIKE '%$searchValue%'OR v.name LIKE '%$searchValue%')";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function updateStokInventory($conn, $inventory_id, $jumlah, $satuan)
    {

        if ($satuan == "Colly") {
            $sql = "UPDATE inventory SET colly = colly + $jumlah WHERE inventory_id = '$inventory_id'";
            $query = mysqli_query($conn, $sql);
        } else if ($satuan == "Dozen") {
            $sql = "UPDATE inventory SET dozen = dozen + $jumlah WHERE inventory_id = '$inventory_id'";
            $query = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE inventory SET piece = piece + $jumlah WHERE inventory_id = '$inventory_id'";
            $query = mysqli_query($conn, $sql);
        }

        if (mysqli_affected_rows($conn) > 0) {
            $successUpdate = true;
        } else {
            $successUpdate = false;
        }

        return $successUpdate;
    }

    public static function getHargaBarangKeluarDalamKotaData($conn)
    {
        $sql = "SELECT a.*, b.name AS NamaBarang, c.name AS NamaPembeli FROM inside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id
        ORDER BY b.name ASC";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getHargaBarangKeluarDalamKotaDataBasedonInventoryIDAndStoreID($conn, $inventory_id, $store_id)
    {
        $sql = "SELECT a.*, b.name AS NamaBarang, c.name AS NamaPembeli FROM inside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE a.inventory_id = '$inventory_id' AND a.store_id = '$store_id'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahHargaBarangKeluarDalamKotaData($conn, $inventory_id, $store_id, $colly, $dozen, $piece, $created_at, $updated_at)
    {
        $sql = "INSERT INTO inside_sell_price (inventory_id, store_id, harga_colly, harga_dozen, 
        harga_piece, created_at, updated_at) VALUES ('$inventory_id', '$store_id', '$colly', 
        '$dozen', '$piece', '$created_at', '$updated_at')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function editHargaBarangKeluarDalamKotaDataBasedonInventoryIDAndStoreID($conn, $inventory_id, $old_store_id, $newStoreID, $newColly, $newDozen, $newPiece)
    {
        $sql = "UPDATE inside_sell_price SET store_id = '$newStoreID', harga_colly = '$newColly', harga_dozen = '$newDozen', harga_piece = '$newPiece' WHERE inventory_id = '$inventory_id' AND store_id = '$old_store_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function deleteHargaBarangKeluarDalamKotaDataBasedonInventoryIDAndStoreID($conn, $inventory_id, $store_id)
    {
        $sql = "DELETE FROM inside_sell_price WHERE inventory_id = '$inventory_id' 
        AND store_id = '$store_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function liveSearchHargaBarangKeluarDalamKotaData($conn, $searchValue)
    {
        $sql = "SELECT a.*, b.name AS NamaBarang, c.name AS NamaToko FROM inside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE (b.name LIKE '%$searchValue%' OR c.name LIKE '%$searchValue%')";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getHargaBarangKeluarLuarKotaData($conn)
    {
        $sql = "SELECT a.*, b.name AS NamaBarang, c.name AS NamaToko FROM outside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id
        ORDER BY b.name ASC";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getHargaBarangKeluarLuarKotaDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "SELECT a.*, b.name AS NamaBarang, c.name AS NamaToko FROM outside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE a.inventory_id = '$inventory_id'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahHargaBarangKeluarLuarKotaData($conn, $inventory_id, $colly, $dozen, $piece, $store_id, $created_at, $updated_at)
    {
        $sql = "INSERT INTO outside_sell_price (inventory_id, harga_colly, harga_dozen, 
        harga_piece, store_id, created_at, updated_at) VALUES ('$inventory_id', '$colly', 
        '$dozen', '$piece', '$store_id', '$created_at', '$updated_at')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function editHargaBarangKeluarLuarKotaDataBasedonInventoryID($conn, $inventory_id, $newColly, $newDozen, $newPiece, $store_id)
    {
        $sql = "UPDATE outside_sell_price SET harga_colly = '$newColly', harga_dozen = '$newDozen', harga_piece = '$newPiece' , store_id = '$store_id' WHERE inventory_id = '$inventory_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function deleteHargaBarangKeluarLuarKotaDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "DELETE FROM outside_sell_price WHERE inventory_id = '$inventory_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function liveSearchHargaBarangKeluarLuarKotaData($conn, $searchValue)
    {
        $sql = "SELECT a.*, b.name AS NamaBarang, c.name NamaToko FROM outside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE (b.name LIKE '%$searchValue%' OR c.name LIKE '%$searchValue%')";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function getVendorData($conn)
    {
        $sql = "SELECT * FROM vendor ORDER BY name";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNewestVendorData($conn)
    {
        $sql = "SELECT * FROM vendor
        ORDER BY created_at DESC LIMIT 1";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaVendorData($conn)
    {
        $sql = "SELECT * FROM vendor";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getIDVendorDataBasedonNamaVendor($conn, $namaVendor)
    {
        $sql = "SELECT vendor_id FROM vendor WHERE name = '$namaVendor'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getVendorDataBasedOnVendorID($conn, $vendor_id)
    {
        $sql = "SELECT * FROM vendor WHERE vendor_id = '$vendor_id'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function editVendorDataBasedonVendorID($conn, $vendor_id, $vendorName, $nohp)
    {
        $sql = "UPDATE vendor SET name = '$vendorName', nohp = '$nohp' WHERE vendor_id = '$vendor_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function deleteVendorDataBasedonVendorID($conn, $vendor_id)
    {
        $sql = "DELETE FROM vendor WHERE vendor_id = '$vendor_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function tambahVendorDataBasedonVendorID($conn, $vendor_id, $namaVendor, $nohp, $created_at, $updated_at)
    {
        $sql = "INSERT INTO vendor (vendor_id, name, nohp,created_at, updated_at) VALUES ('$vendor_id', '$namaVendor', '$nohp', '$created_at', '$updated_at')";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function liveSearchVendorData($conn, $searchValue)
    {
        $sql = "SELECT * FROM vendor WHERE name LIKE '%$searchValue%'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getTokoData($conn)
    {
        $sql = "SELECT * FROM store ORDER BY name ASC";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNewestTokoData($conn)
    {
        $sql = "SELECT * FROM store
        ORDER BY created_at DESC LIMIT 1";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaTokoData($conn)
    {
        $sql = "SELECT name FROM store";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaTokoDalamKotaData($conn)
    {
        $sql = "SELECT name FROM store where location ='Dalam Kota' OR name='Perorangan'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaTokoLuarKotaData($conn)
    {
        $sql = "SELECT name FROM store where location ='Luar Kota'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function getInfoTokoBasedonNamaToko($conn, $namaToko)
    {
        $sql = "SELECT location FROM store WHERE name = '$namaToko'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInfoTokoData($conn)
    {
        $sql = "SELECT store_id, name FROM store";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function getNamaBarangTokoPeroranganData($conn)
    {
        $sql = "SELECT b.name FROM inside_sell_price a INNER JOIN inventory b
        ON a.inventory_id = b.inventory_id WHERE a.store_id = 'S000001'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaBarangBasedonStoreName($conn, $store, $location)
    {
        if ($location == "Dalam Kota") {

            $sql = "
            SELECT c.name 
            FROM store a 
            INNER JOIN inside_sell_price b ON a.store_id = b.store_id 
            INNER JOIN inventory c ON b.inventory_id = c.inventory_id 
            WHERE a.name = '$store'
        ";
        } else {

            $sql = "
            SELECT c.name 
            FROM store a 
            INNER JOIN outside_sell_price b ON a.store_id = b.store_id 
            INNER JOIN inventory c ON b.inventory_id = c.inventory_id 
            WHERE a.name = '$store'
        ";
        }

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function getNamaBarangInsideTokoData($conn)
    {
        $sql = "SELECT b.name FROM inside_sell_price a INNER JOIN inventory b
        ON a.inventory_id = b.inventory_id WHERE a.store_id != 'S000001'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNamaBarangOutsideTokoData($conn)
    {
        $sql = "SELECT b.name FROM outside_sell_price a INNER JOIN inventory b
        ON a.inventory_id = b.inventory_id";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getIDTokoDataBasedonNamaToko($conn, $namaToko)
    {
        $sql = "SELECT store_id FROM store WHERE name = '$namaToko'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function tambahTokoDataBasedonStoreID($conn, $store_id, $namaToko, $nohp, $daerahToko, $daerah, $created_at, $updated_at)
    {
        $sql = "INSERT INTO store (store_id, name, nohp, location, city, created_at, updated_at) VALUES ('$store_id', '$namaToko', '$nohp', '$daerahToko', '$daerah', '$created_at', '$updated_at')";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function getTokoDataBasedOnStoreID($conn, $store_id)
    {
        $sql = "SELECT * FROM store WHERE store_id = '$store_id'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getStoreIDBasedOnNamaToko($conn, $namaToko)
    {
        $sql = "SELECT store_id FROM store WHERE name = '$namaToko'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function deleteTokoDataBasedonStoreID($conn, $store_id)
    {
        $sql = "DELETE FROM store WHERE store_id = '$store_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function editTokoDataBasedonStoreID($conn, $store_id, $storeName, $nohp, $location, $daerah)
    {
        $sql = "UPDATE store SET name = '$storeName', nohp = '$nohp', location = '$location', city = '$daerah' WHERE store_id = '$store_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function liveSearchTokoData($conn, $searchValue)
    {
        $sql = "SELECT * FROM store WHERE (name LIKE '%$searchValue%' OR location LIKE '%$searchValue%')";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getStokinData($conn)
    {
        $sql = "SELECT * FROM stock_in a LEFT JOIN vendor b ON a.vendor_id = b.vendor_id
        ORDER BY a.date ASC";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNewestStokinData($conn)
    {
        $sql = "SELECT * FROM stock_in a LEFT JOIN vendor b ON a.vendor_id = b.vendor_id
        ORDER BY date DESC LIMIT 1";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getFullStokinDataBasedonDate($conn, $date)
    {
        $start = $date . " 00:00:01";
        $end   = $date . " 23:59:59";

        // echo $start;
        // echo $end;

        $sql = "SELECT c.colly, c.dozen, b.quantity, b.unit, b.subtotal FROM stock_in a INNER JOIN stock_in_detail b ON a.stock_in_id = b.stock_in_id INNER JOIN inventory c ON b.inventory_id = c.inventory_id AND a.date BETWEEN '$start' AND '$end'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getStokinDetailData($conn)
    {
        $sql = "SELECT a.* FROM stock_in_detail a INNER JOIN stock_in b ON a.stock_in_id = b.stock_in_id INNER JOIN inventory c ON a.inventory_id = c.inventory_id";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getFullStokinData($conn, $stock_in_id)
    {
        $sql = "SELECT a.*, b.*, c.name as NamaBarang, d.name as NamaVendor FROM stock_in a INNER JOIN stock_in_detail b ON a.stock_in_id = b.stock_in_id INNER JOIN inventory c ON b.inventory_id = c.inventory_id INNER JOIN vendor d ON a.vendor_id = d.vendor_id WHERE a.stock_in_id = '$stock_in_id'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahStokinData($conn, $stock_in_id, $date, $vendor_id, $total, $user_id, $created_at, $updated_at)
    {
        $sql = "INSERT INTO stock_in (stock_in_id, date, vendor_id, total, user_id, created_at,
        updated_at) VALUES ('$stock_in_id', '$date', '$vendor_id', '$total', '$user_id', 
        '$created_at', '$updated_at')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function tambahStokinDetailData($conn, $stock_in_detail_id, $stock_in_id, $inventory_id, $quantity, $unit, $buy_price, $subtotal)
    {
        $sql = "INSERT INTO stock_in_detail (stock_in_detail_id, stock_in_id, inventory_id, quantity, unit, buy_price, subtotal) VALUES ('$stock_in_detail_id', '$stock_in_id', '$inventory_id', '$quantity', '$unit', '$buy_price', '$subtotal')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function editStokInDetail($conn, $stock_in_detail_id, $stock_in_id, 
    $inventory_id, $quantity, $unit, $sellPrice, $subTotal)
    {
        $sql = "UPDATE stock_in_detail SET quantity = '$quantity', unit = '$unit', 
        buy_price = '$sellPrice', subtotal = '$subTotal' WHERE stock_in_detail_id = '$stock_in_detail_id' AND stock_in_id = '$stock_in_id' AND inventory_id = '$inventory_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function deleteStokInDataBasedonStokInId($conn, $stock_in_id)
    {
        $sql = "DELETE FROM stock_in WHERE stock_in_id = '$stock_in_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function liveSearchStokInData($conn, $searchValue)
    {
        $sql = "SELECT * FROM stock_in a LEFT JOIN vendor b ON a.vendor_id = b.vendor_id WHERE 
        (b.name LIKE '%$searchValue%')";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function getStokOutGeneralData($conn)
    {
        $sql = "SELECT * FROM stock_out_general a LEFT JOIN user b ON a.user_id = b.username
        ORDER BY a.date ASC";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNewestStokOutGeneralData($conn)
    {
        $sql = "SELECT * FROM stock_out_general a LEFT JOIN user b ON a.user_id = b.username
        ORDER BY date DESC LIMIT 1";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getFullStokOutGeneralData($conn, $stock_out_general_id)
    {
        $sql = "SELECT a.*, b.*, c.name as NamaBarang FROM stock_out_general a INNER JOIN stock_out_general_detail b ON a.out_general_id = b.out_general_id INNER JOIN inventory c ON b.inventory_id = c.inventory_id WHERE a.out_general_id = '$stock_out_general_id'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getFullStokOutGeneralDataBasedonDate($conn, $date)
    {
        $start = $date . " 00:00:01";
        $end = $date . " 23:59:59";
        
        $sql = "SELECT a.*, b.*, c.name as NamaBarang FROM stock_out_general a INNER JOIN stock_out_general_detail b ON a.out_general_id = b.out_general_id INNER JOIN inventory c ON b.inventory_id = c.inventory_id WHERE a.date BETWEEN '$start' AND '$end' ";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahStokOutGeneralData(
        $conn,
        $stock_out_general_id,
        $date,
        $total,
        $user_id,
        $created_at,
        $updated_at
    ) {
        $sql = "INSERT INTO stock_out_general (out_general_id, date, total, user_id, created_at, updated_at) VALUES ('$stock_out_general_id', '$date', '$total', '$user_id', '$created_at', 
        '$updated_at')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function deleteStokOutGeneralDataBasedonStokOutGeneralID($conn, $stock_out_general_id)
    {
        $sql = "DELETE FROM stock_out_general WHERE out_general_id = '$stock_out_general_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function liveSearchStokOutGeneralData($conn, $searchValue)
    {
        $sql = "SELECT * FROM stock_out_general WHERE user_id LIKE '%$searchValue%'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function liveSearchDateStokOutGeneralData($conn, $dateAwal, $dateAkhir)
    {
        $sql = "SELECT * FROM stock_out_general WHERE date BETWEEN '$dateAwal' AND '$dateAkhir'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahStokOutGeneralDetailData($conn, $stock_out_general_detail_id, $stock_out_general_id, $inventory_id, $quantity, $unit, $sell_price, $subtotal)
    {
        $sql = "INSERT INTO stock_out_general_detail (out_general_detail_id, out_general_id, inventory_id, quantity, unit, sale_price, subtotal) VALUES ('$stock_out_general_detail_id', '$stock_out_general_id', '$inventory_id', '$quantity', '$unit', '$sell_price', '$subtotal')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function editStokOutGeneralDetail($conn, $out_general_detail_id, $out_general_id, 
    $inventory_id, $quantity, $unit, $sellPrice, $subTotal)
    {
        $sql = "UPDATE stock_out_general_detail SET quantity = '$quantity', unit = '$unit', 
        sale_price = '$sellPrice', subtotal = '$subTotal' WHERE out_general_detail_id = '$out_general_detail_id' AND out_general_id = '$out_general_id' AND inventory_id = '$inventory_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function getInfoBarangGeneralDataBasedonNamaBarang($conn, $namaBarang)
    {
        $sql = "SELECT a.inventory_id AS inventory_id, a.harga_colly AS HargaJualColly, a.harga_dozen AS HargaJualDozen, a.harga_piece AS HargaJualPiece FROM inside_sell_price a INNER JOIN inventory b ON 
        a.inventory_id = b.inventory_id WHERE b.name = '$namaBarang' AND a.store_id = 'S000001'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInfoBarangTokoDataBasedonNamaBarang($conn, $namaBarang, $location)
    {
        if ($location == "Dalam Kota") {
            $sql = "SELECT a.inventory_id AS inventory_id, a.harga_colly AS HargaJualColly, 
            a.harga_dozen AS HargaJualDozen, a.harga_piece AS HargaJualPiece FROM inside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE b.name = '$namaBarang' AND a.store_id != 'S000001'";

            $query = mysqli_query($conn, $sql);

            $results = [];

            while ($result = mysqli_fetch_assoc($query)) {
                $results[] = $result;
            }
        } else {
            $sql = "SELECT a.inventory_id AS inventory_id, a.harga_colly AS HargaJualColly, 
            a.harga_dozen AS HargaJualDozen, a.harga_piece AS HargaJualPiece FROM outside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE b.name = '$namaBarang' AND a.store_id != 'S000001'";

            $query = mysqli_query($conn, $sql);

            $results = [];

            while ($result = mysqli_fetch_assoc($query)) {
                $results[] = $result;
            }
        }

        return $results;
    }

    public static function getInfoBarangGeneralDataBasedonInventoryID($conn, $inventory_id)
    {
        $sql = "SELECT a.inventory_id AS inventory_id, a.harga_colly AS HargaJualColly, a.harga_dozen AS HargaJualDozen, a.harga_piece AS HargaJualPiece FROM inside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id WHERE a.inventory_id = '$inventory_id' AND a.store_id = 'S000001'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getInfoBarangTokoDataBasedonInventoryID($conn, $inventory_id, $location, $store)
    {
        if ($location == "Dalam Kota") {
            $sql = "SELECT a.inventory_id AS inventory_id, a.harga_colly AS HargaJualColly, a.harga_dozen AS HargaJualDozen, a.harga_piece AS HargaJualPiece FROM inside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE a.inventory_id = '$inventory_id' AND c.name = '$store'";

            $query = mysqli_query($conn, $sql);

            $results = [];

            while ($result = mysqli_fetch_assoc($query)) {
                $results[] = $result;
            }
        } else {
            $sql = "SELECT a.inventory_id AS inventory_id, a.harga_colly AS HargaJualColly, a.harga_dozen AS HargaJualDozen, a.harga_piece AS HargaJualPiece FROM outside_sell_price a INNER JOIN inventory b ON a.inventory_id = b.inventory_id INNER JOIN store c ON a.store_id = c.store_id WHERE a.inventory_id = '$inventory_id' AND c.name = '$store'";

            $query = mysqli_query($conn, $sql);

            $results = [];

            while ($result = mysqli_fetch_assoc($query)) {
                $results[] = $result;
            }
        }

        return $results;
    }

    public static function getStokOutTokoData($conn)
    {
        $sql = "SELECT a.*, b.name AS NamaToko, c.username AS NamaPegawai FROM stock_out_store a INNER JOIN store b ON a.store_id = b.store_id INNER JOIN user c ON a.user_id = c.username
        ORDER BY a.date ASC";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getNewestStokOutTokoData($conn)
    {
        $sql = "SELECT a.*, b.name AS NamaToko, c.username AS NamaPegawai FROM stock_out_store a INNER JOIN store b ON a.store_id = b.store_id INNER JOIN user c ON a.user_id = c.username
        ORDER BY a.date DESC LIMIT 1";
        
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function tambahStokOutTokoData(
        $conn,
        $stock_out_toko_id,
        $store_id,
        $date,
        $total,
        $user_id,
        $created_at,
        $updated_at
    ) {
        $sql = "INSERT INTO stock_out_store (out_store_id, store_id, date, total, user_id, created_at, updated_at) VALUES ('$stock_out_toko_id','$store_id', '$date', '$total', '$user_id', '$created_at', 
        '$updated_at')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function tambahStokOutTokoDetailData($conn, $stock_out_toko_detail_id, $stock_out_toko_id, $inventory_id, $quantity, $unit, $sell_price, $subtotal)
    {
        $sql = "INSERT INTO stock_out_store_detail (out_store_detail_id, out_store_id, inventory_id, quantity, unit, sale_price, subtotal) VALUES ('$stock_out_toko_detail_id', '$stock_out_toko_id', '$inventory_id', '$quantity', '$unit', '$sell_price', '$subtotal')";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function editStokOutTokoDetail($conn, $out_store_detail_id, $out_store_id, 
    $inventory_id, $quantity, $unit, $sellPrice, $subTotal)
    {
        $sql = "UPDATE stock_out_store_detail SET quantity = '$quantity', unit = '$unit', 
        sale_price = '$sellPrice', subtotal = '$subTotal' WHERE out_store_detail_id = '$out_store_detail_id' AND out_store_id = '$out_store_id' AND inventory_id = '$inventory_id'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function liveSearchStokOutTokoData($conn, $searchValue)
    {
        $sql = "SELECT a.*, b.name AS NamaToko, c.name AS NamaPegawai FROM stock_out_store a INNER JOIN store b ON a.store_id = b.store_id INNER JOIN user c ON a.user_id = c.username WHERE( c.name LIKE '%$searchValue%' OR b.name LIKE '%$searchValue%')";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function liveSearchDateStokOutTokoData($conn, $dateAwal, $dateAkhir)
    {
        $sql = "SELECT a.*, b.name AS NamaToko, c.name AS NamaPegawai FROM stock_out_store a INNER JOIN store b ON a.store_id = b.store_id INNER JOIN user c ON a.user_id = c.username WHERE a.date BETWEEN '$dateAwal' AND '$dateAkhir'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function deleteStokOutTokoDataBasedonStokOutTokoID($conn, $stock_out_store_id)
    {
        $sql = "DELETE FROM stock_out_store WHERE out_store_id = '$stock_out_store_id'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function getFullStokOutTokoData($conn, $stock_out_store_id)
    {
        $sql = "SELECT a.*, b.*, c.name AS NamaBarang, d.name AS NamaToko FROM stock_out_store a INNER JOIN stock_out_store_detail b ON a.out_store_id = b.out_store_id INNER JOIN inventory c ON b.inventory_id = c.inventory_id INNER JOIN store d ON a.store_id = d.store_id WHERE a.out_store_id = '$stock_out_store_id'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getFullStokOutTokoBasedonDate($conn, $date)
    {
        $start = $date . " 00:00:01";
        $end = $date . " 23:59:59";

        $sql = "SELECT a.*, b.*, c.name AS NamaBarang, d.name AS NamaToko FROM stock_out_store a INNER JOIN stock_out_store_detail b ON a.out_store_id = b.out_store_id INNER JOIN inventory c ON b.inventory_id = c.inventory_id INNER JOIN store d ON a.store_id = d.store_id WHERE a.date BETWEEN '$start' AND '$end'";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getUserData($conn)
    {
        $sql = "SELECT * FROM user";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getUserDataBasedonUsername($conn, $username)
    {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function editUserDataBasedonUsername($conn, $username, $name, $password)
    {
        // $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE user SET name = '$name', password = '$password' WHERE
        username = '$username'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successEdit = true;
        } else {
            $successEdit = false;
        }

        return $successEdit;
    }

    public static function deleteUserDataBasedonUsername($conn, $username)
    {
        $sql = "DELETE FROM user WHERE username = '$username'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successDelete = true;
        } else {
            $successDelete = false;
        }

        return $successDelete;
    }

    public static function tambahUserDataBasedonUsername($conn, $username, $name, $password, $type, $created_at, $updated_at)
    {
        // $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (username, name, password, type,created_at, updated_at) VALUES ('$username', '$name', '$password', '$type', '$created_at', '$updated_at')";
        $query = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) > 0) {
            $successTambah = true;
        } else {
            $successTambah = false;
        }

        return $successTambah;
    }

    public static function liveSearchUserData($conn, $searchValue)
    {
        $sql = "SELECT * FROM user WHERE (username LIKE '%$searchValue%' OR name LIKE '%$searchValue%')";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }


    public static function getFullStokOutGeneralDataChart($conn)
    {
        
        $sql = "SELECT DATE_FORMAT(date, '%d/%m/%Y') as tgl, SUM(subtotal) AS Subtotal FROM stock_out_general a INNER JOIN stock_out_general_detail b ON a.out_general_id = b.out_general_id WHERE a.date >= CURDATE() - INTERVAL 6 DAY GROUP BY tgl";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }

    public static function getFullStokOutTokoDataChart($conn)
    {
        $sql = "SELECT DATE_FORMAT(date, '%d/%m/%Y') as tgl, SUM(subtotal) AS Subtotal FROM stock_out_store a INNER JOIN stock_out_store_detail b ON a.out_store_id = b.out_store_id WHERE a.date >= CURDATE() - INTERVAL 6 DAY GROUP BY tgl";

        $query = mysqli_query($conn, $sql);

        $results = [];

        while ($result = mysqli_fetch_assoc($query)) {
            $results[] = $result;
        }

        return $results;
    }
    
    // public static function getTotalPendapatanChart(){
    //     $sql = "SELECT DATE(tanggal) AS tgl, SUM(pendapatan) AS pendapatan, SUM(pengeluaran) AS pengeluaran FROM transaksi WHERE tanggal >= CURDATE() - INTERVAL 6 DAY GROUP BY DATE(tanggal)"
    // }
}