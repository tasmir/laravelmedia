<p align="center">Laravel Media</p>

<p align="center">
<img src="https://img.shields.io/packagist/dt/tasmir/laravelmedia" alt="Total Downloads">
<img src="https://img.shields.io/packagist/v/tasmir/laravelmedia" alt="Latest Stable Version">
<img src="https://img.shields.io/packagist/l/tasmir/laravelmedia" alt="License">
</p>
After complete your Installation,

Add Provider 


`config > app.php`

```
'providers' => [
..
 Tasmir\LaravelMedia\LaravelMediaServiceProvider::class,
 ..
```

just add `@include("laravelmedia::media") ` bellow to your blade file. Make sure, your console has no error.



