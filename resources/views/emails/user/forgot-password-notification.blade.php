Halo {!! $model->name !!} <br/><br/>

Anda lupa password, silahkan untuk reset ulang password Anda dengan menglik link dibawah ini.<br/><br/>
<a href="{!! $model->getUrlForgotPassword() !!}">{!! $model->getUrlForgotPassword() !!}</a> <br/><br/>

Terima Kasih, <br/>
{{ config('app.name') }}