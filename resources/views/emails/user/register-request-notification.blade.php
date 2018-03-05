Halo Kawan <br/><br/>

{!! $userRelation->name !!} telah bergabung bersama kami di {!! config('app.name') !!} dan memilih Anda sebagai pasangannya.<br/>
Segera bergabung bersama kami dengan mengklik link dibawah ini dan terlebih dahulu Download Aplikasi kami di App Store.<br/><br/>
<a href="{!! $model->getUrlRegisteredRequest() !!}">{!! $model->getUrlRegisteredRequest() !!}</a> <br/><br/>
Berikut adalah detail dari pasangan Anda:<br/>
Nama : {!! $userRelation->name !!}<br/>
Email : {!! $userRelation->email !!}<br/>
No Handphone : {!! $userRelation->phone !!}<br/><br/>

Terima Kasih, <br/>
{{ config('app.name') }}