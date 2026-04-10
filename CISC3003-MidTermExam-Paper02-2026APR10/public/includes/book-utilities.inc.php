<?php

function readCustomers($filename) {
    $customers = [];
    if (!file_exists($filename) || !is_readable($filename)) {
        return $customers;
    }
    $fileHandle = fopen($filename, 'r');
    if ($fileHandle) {
        while (($line = fgets($fileHandle)) !== false) {
            $trimmedLine = trim($line);
            if (empty($trimmedLine)) {
                continue;
            }
            $fields = explode(';', $trimmedLine);
            if (count($fields) < 12) {
                continue;
            }
            $customerId = trim($fields[0]);
            $customers[$customerId] = [
                'id'         => $customerId,
                'first_name' => trim($fields[1]),
                'last_name'  => trim($fields[2]),
                'email'      => trim($fields[3]),
                'university' => trim($fields[4]),
                'address'    => trim($fields[5]),
                'city'       => trim($fields[6]),
                'state'      => trim($fields[7]),
                'country'    => trim($fields[8]),
                'zip'        => trim($fields[9]),
                'phone'      => trim($fields[10]),
                'sales'      => trim($fields[11])
            ];
        }
        fclose($fileHandle);
    }
    return $customers;
}


function readOrders($customerId, $filename) {
    $orders = [];
    $targetCustomerId = trim($customerId);
    if (empty($targetCustomerId) || !file_exists($filename) || !is_readable($filename)) {
        return $orders;
    }
    $fileHandle = fopen($filename, 'r');
    if ($fileHandle) {
        while (($line = fgets($fileHandle)) !== false) {
            $trimmedLine = trim($line);
            if (empty($trimmedLine)) {
                continue;
            }
            $fields = explode(',', $trimmedLine);
            if (count($fields) < 5) {
                continue;
            }
            $orderCustomerId = trim($fields[1]);
            if ($orderCustomerId === $targetCustomerId) {
                $orders[] = [
                    'order_id'   => trim($fields[0]),
                    'customer_id'=> $orderCustomerId,
                    'isbn'       => trim($fields[2]),
                    'title'      => trim($fields[3]),
                    'category'   => trim($fields[4])
                ];
            }
        }
        fclose($fileHandle);
    }
    return $orders;
}
?>