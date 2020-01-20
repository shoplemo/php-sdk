<?php
    require_once('../Bootstrap.php');

    $config = new \Shoplemo\Config();
    $config->setAPIKey('TEST'); // API KEY
    $config->setSecretKey('TEST'); // API SECRET
    $config->setServiceBaseUrl('https://payment.shoplemo.com');

    // credit - debit - prepaid card;
    $request = new \Shoplemo\Paywith\CreditCard($config);

    $request->setUserEmail('test@shoplemo.tdl'); // customer email address
    $request->setCustomParams(json_encode(['custom_param' => 'testing','order_id' => '104817'])); // custom params, must be JSON

    //create a basket
    $basket = new \Shoplemo\Model\Basket;
    $basket->setTotalPrice(2000); // total price * 100

    //create a product
    $item1  = new \Shoplemo\Model\BasketItem;
    $item1->setName('Test Item');
    $item1->setPrice(1000); // per price * 100 
    $item1->setType(\Shoplemo\Model\BasketItem::DIGITAL); // DIGITAL product
    $item1->setQuantity(1); //quantity

    $item2  = new \Shoplemo\Model\BasketItem;
    $item2->setName('Nike Airmax');
    $item2->setPrice(1000); // price * 100 
    $item2->setType(\Shoplemo\Model\BasketItem::PHYSICAL); // PHYSICAL product
    $item2->setQuantity(1);

    // add products to basket
    $basket->addItem($item1);
    $basket->addItem($item2);

    // buyer info. (fields are optional)
    $buyer = new \Shoplemo\Model\Buyer;
    $buyer->setIdentityNumber("TC_KIMLIK"); // Turkish citizen id number for KYC (optional)
    $buyer->setName('Emrah');
    $buyer->setSurname('ÖZDEMİR');
    $buyer->setGsm("905300000000"); // phone number
    $buyer->setCity("Izmir"); // city
    $buyer->setCountry("Turkey"); // country

     // shipping info. (fields are optional) not need for DIGITAL product
    $shipping = new \Shoplemo\Model\Shipping;
    $shipping->setFullName("EMRAH OZDEMIR"); // who is receive the shipment
    $shipping->setPhone("905300000000"); // phone number
    $shipping->setAddress("PHP Caddesi No:7/4 Daire:10"); // address
    $shipping->setPostalCode("35000"); // postalcode
    $shipping->setCity('Izmir'); // city
    $shipping->setCountry("Turkey"); // country

     // billing info. (fields are optional) not need for DIGITAL product
    $billing = new \Shoplemo\Model\Billing;
    $billing->setFullName("EMRAH OZDEMIR"); // name surname / corporate name
    $billing->setTaxNumber("XXXXXXXX"); // tax number for company / id number for person
    $billing->setTaxHouse("IZMIR"); // tax house 
    $billing->setPhone("905300000000"); // phone number
    $billing->setAddress("PHP Caddesi No:7/4 Daire:10"); // address
    $billing->setPostalCode("35000"); // postal code
    $billing->setCity('Izmir'); // city
    $billing->setCountry("Turkey"); // country

    // set objects to Request
    $request->setBasket($basket);
    $request->setBuyer($buyer);
    $request->setShipping($shipping);
    $request->setBilling($billing);

    if($request->execute()){ // execute request

        //echo $request->getResponse(); // success response
        try{
         
            $response = json_decode($request->getResponse(),true);
            if($response['status'] == 'success'){
                ?>
                    <div id="shoplemo-area">
                        <script src="//payment.shoplemo.com/assets/js/shoplemo.js"></script>
                        <iframe src="<?php $response['url'] ?>" id="shoplemoiframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>

                        <script type="text/javascript">
                            setTimeout(function(){ 
                                iFrameResize({ log: false },'#shoplemoiframe');
                            }, 1000);
                        </script>
                    </div>
                <?php
            }
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
    }else{
        echo $request->getError(); // got a error
    }