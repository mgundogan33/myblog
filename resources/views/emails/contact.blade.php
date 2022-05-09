@component('mail::message')
# Kullanıcı Mesajı

Bir Ziyaretçi Mesaj Bıraktı:
<br><br>
Isim:{{$firstname}}
<br>
Soyisim:{{$secondname}}
<br>
Email:{{$email}}
<br>
Konu:{{$subject}}
<br>
Mesajınız:{{$message}}

@component('mail::button', ['url' => ''])
Yeni Mesaj
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
