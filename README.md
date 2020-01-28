# shoplemo/php-sdk
[![Latest Stable Version](https://poser.pugx.org/shoplemo/php-sdk/v/stable)](https://packagist.org/packages/shoplemo/php-sdk)
[![Build Status](https://travis-ci.org/shoplemo/php-sdk.svg?branch=master)](https://travis-ci.org/shoplemo/php-sdk)

Bu kütüphaneyi kullanmak için onaylı bir shoplemo satıcı hesabına ve mağazasına sahip olmanız gerekmektedir. Shoplemo'ya https://www.shoplemo.com adresinden ulaşabilirsiniz.

Bu servisle ile ilgili doküman https://payment.shoplemo.com/doc adresindedir.

# Gereklilik

PHP 5.6 ve üzeri.

# Kurulum

### Composer

 [Composer](http://getcomposer.org/) aracılığı ile kullanmak için bu komutu yürütün:

```bash
composer require shoplemo/php-sdk
```

Tanımlamak için Composer [autoload](https://getcomposer.org/doc/00-intro.md#autoloading) dosyasını çağırın:

```php
require_once('vendor/autoload.php');
```

### Composer Olmadan

Composer kullanmak istemiyorsanız, sdk'nin son sürümünü [latest release](https://github.com/shoplemo/php-sdk/releases) adresinden indirebilirsiniz.
Daha sonra kullanmak için indirdiğiniz klasörün içinde yer alan `Bootstrap.php` dosyasını projenize dahil etmeniz yeterli olacaktır. 

```php
require_once('/path/to/php-sdk/Bootstrap.php');
```

# Kullanım Örneği

```php
$config = new \Shoplemo\Config();
$config->setAPIKey('TEST');
$config->setSecretKey('TEST');
$config->setServiceBaseUrl('https://payment.shoplemo.com');

// kredi kartı ile ödeme başlatmak için;
$request = new \Shoplemo\Paywith\CreditCard($config);

$request->setUserEmail('test@shoplemo.tdl'); // ödemeyi yapacak kullanıcının email adresi
$request->setCustomParams(json_encode(['custom_param1' => 'deneme'])); // ödeme işlemi başlamadan önce işlemi takip etmek isteyebileceğiniz parametreleri iletebilirsiniz. Bu parametre Json formatında olmalıdır.

//sepet oluşturuyoruz;
$basket = new \Shoplemo\Model\Basket;
$basket->setTotalPrice(2000); // sepetteki ürünlerin toplam tutarını iletiyoruz. Bu aynı zamanda kullanıcıdan alınacak ödeme tutarıdır. (toplam tutar * 100)

//sepet eklemek için ürün oluşturuyoruz;
$item1  = new \Shoplemo\Model\BasketItem;
$item1->setName('Test 1');
$item1->setPrice(1000); //price *100
$item1->setType(\Shoplemo\Model\BasketItem::DIGITAL); // dijital ürün
$item1->setQuantity(1);

$item2  = new \Shoplemo\Model\BasketItem;
$item2->setName('Test 2');
$item2->setPrice(1000); // price * 100
$item2->setType(\Shoplemo\Model\BasketItem::PHYSICAL); // fiziksel ürün
$item2->setQuantity(1);

// oluşturduğumuz ürünleri, sepete ekliyoruz.
$basket->addItem($item1);
$basket->addItem($item2);

// alıcı ile ilgili elimizde olan bilgileri paylaşabilirsiniz. (opsiyonel)
$buyer = new \Shoplemo\Model\Buyer;
$buyer->setIdentityNumber('TC_KIMLIK'); // kişiye ait vatandaşlık numarası (kyc prosedürü gerektiren durumlar için yollayabilirsiniz.)
$buyer->setName('Emrah');
$buyer->setSurname('ÖZDEMİR');
$buyer->setGsm('905300000000'); // telefon numarası
$buyer->setCity('Izmir'); // şehir
$buyer->setCountry('Turkey'); // ülke

$shipping = new \Shoplemo\Model\Shipping;
$shipping->setFullName('EMRAH OZDEMIR'); // alıcının adı
$shipping->setPhone('905300000000'); // alıcının telefon numarası 
$shipping->setAddress('PHP Caddesi No:7/4 Daire:10'); // Adres
$shipping->setPostalCode('35000'); // posta kutusu
$shipping->setCity('Izmir'); //şehir
$shipping->setCountry('Turkey'); // ülke

$billing = new \Shoplemo\Model\Billing;
$billing->setFullName('EMRAH OZDEMIR'); // fatura kesilecek kişinin yada kurumun adı
$billing->setTaxNumber('XXXXXXXX'); // kurumlar için vergi numarası, şahıslar için vatandaşlık numarası
$billing->setTaxHouse('IZMIR'); // kurumlar için vergi dairesi, şahıslar için yaşadığı şehir
$billing->setPhone('905300000000'); // atura kesilecek kişinin telefon numarası 
$billing->setAddress('PHP Caddesi No:7/4 Daire:10'); // atura kesilecek kişinin adresi
$billing->setPostalCode('35000'); // posta kutusu
$billing->setCity('Izmir'); //şehir
$billing->setCountry('Turkey'); // ülke

// yapılan tanımlamaları $request içerisine aktarıyoruz.
$request->setBasket($basket);
$request->setBuyer($buyer);
$request->setShipping($shipping);
$request->setBilling($billing);

if($request->execute()){ // request'i işleme alıyoruz.
   echo $request->getResponse(); // başarılı sonuç alınırsa json formatında yanıt döner.
}else{
   echo $request->getError(); // hata durumunda, hata mesajını yazdırır.
}

```
Daha fazla örnek yakında eklenecektir.
