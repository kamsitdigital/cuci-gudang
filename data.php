<?php


$paginate   = !empty($_GET['page']) ? $_GET['page'] : 0;

echo getData($paginate);

function getData($paginate = 0){
    $url    = 'https://importir.com/api/get-crowdfund-indonesia?page=' . $paginate;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close ($ch);

    $result     = json_decode($server_output);

    if(count($result->data) == 0){
        return json_encode([]);
    }

    $response   = [];
    foreach ($result->data as $datum){
        $text   = (strlen($datum->title_en) > 60) ? substr($datum->title_en, 0, 57) . '...' : $datum->title_en;
        $response[] = [
            'product_id'    => $datum->product_id,
            'title_en'      => $text,
            'image'         => $datum->image,
            'price'         => number_format($datum->price_only,0),
            'wa_link'       => 'https://api.whatsapp.com/send?phone=6281398080314&text=Hallo,%20saya%20ingin%20bertanya%20produk%20SKU%20'. $datum->product_id .',%20apakah%20masih%20ada'
        ];
    }

    return json_encode($response);

// Further processing ...
    if ($server_output == "OK") {

    } else {

    }
}