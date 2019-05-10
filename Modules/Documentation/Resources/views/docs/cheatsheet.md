# پاراگراف
```
پاراگراف ها به وسیله اینتر از هم جدا میشوند.

این یک پاراگراف دیگر است.
```
پاراگراف ها به وسیله لاین فاصله از هم جدا میشوند.

این یک پاراگراف دیگر است.

---

# استایل فونت
```
در مارک داون بسیار ساده میشود عبارتی را *ایتالیک* و عبارت دیگر را **بولد** کرد.

هر عبارتی که در بین دوحرف ~ قرار گیرد ( مانند ~~این~~ ) بصورت خط کشیده نشان داده خواهد شد.
```

در مارک داون بسیار ساده میشود عبارتی را *ایتالیک* و عبارت دیگر را **بولد** کرد.

هر عبارتی که در بین دوحرف ~ قرار گیرد ( مانند ~~این~~ ) بصورت خط کشیده نشان داده خواهد شد.

---

# سرتیتر ها
```
برای نمایش سرتیتر ها از علامت # در ابتدای لاین استفاده شده و بسته به تعداد آن میتوان سرتیتر های h1 تا h6 را داشت

مانند مثال زیر:
# سرتیتر h1
## سرتیتر h2
### سرتیتر h3
#### سرتیتر h4
##### سرتیتر h5
###### سرتیتر h6
```

برای نمایش سرتیتر ها از علامت # در ابتدای لاین استفاده شده و بسته به تعداد آن میتوان سرتیتر های h1 تا h6 را داشت

مانند مثال زیر:
# سرتیتر h1 {docsify-ignore}
## سرتیتر h2 {docsify-ignore}
### سرتیتر h3 {docsify-ignore}
#### سرتیتر h4 {docsify-ignore}
##### سرتیتر h5 {docsify-ignore}
###### سرتیتر h6 {docsify-ignore}

---

# لینک
```
این یک مثلا برای لینک دادن به [گوگل](https://www.google.com/) است.
```

این یک مثال برای لینک دادن به [گوگل](https://www.google.com/) است.

---

# لیست ها
```
لیست غیر ترتیبی
* با علامت ستاره شروع می شود
* غذا
  * میوه
    * پرتقال
    * سیب

لیست ترتیبی:
1. یک
2. دو
3. سه
```

لیست غیر ترتیبی
* با علامت ستاره شروع می شود
* غذا
  * میوه
    * پرتقال
    * سیب

لیست ترتیبی:
1. یک
2. دو
3. سه

?> برای ساخت لیست های غیرترتیبی میتوان از علامت های + و - نیز استفاده کرد.

---

# جدا کننده
```
بدین صورت میتوان دو بخش را

---
از هم جدا کرد.
```

بدین صورت میتوان دو بخش را

---
از هم جدا کرد.

---

# نقل قول
```
در صورتی که میخواهید از کسی نقل قول نمایید قبل از لاین علامت < را قرار دهید.

> این یک نقل قول است.
>
> این یک پاراگراف دیگر است.
```
در صورتی که میخواهید از کسی نقل قول نمایید قبل از لاین علامت < را قرار دهید.

> این یک نقل قول است.
>
> این یک پاراگراف دیگر است.

---

# عکس
```
اگر میخواهید عکسی را در صفحه نمایش دهید میتوان بدین صورت عمل کرد:

![vuejs logo](https://vuejs.org/images/logo.png ':size=100')
```
اگر میخواهید عکسی را در صفحه نمایش دهید میتوان بدین صورت عمل کرد:

![vuejs logo](https://vuejs.org/images/logo.png ':size=100')

---

# جدول
```
| **سرتیر اول** | **سرتیتر دوم**   | **سرتیتر سوم**  |
| ----------- |:---------:| ----------:|
| ستون اول | ستون دوم | ستون سوم |
| ستون اول | ستون دوم | ستون سوم |
| ستون اول | ستون دوم | ستون سوم |
```
| **سرتیر اول** | **سرتیتر دوم**   | **سرتیتر سوم**  |
| ----------- |:---------:| ----------:|
| ستون اول | ستون دوم | ستون سوم |
| ستون اول | ستون دوم | ستون سوم |
| ستون اول | ستون دوم | ستون سوم |

---

# کد
```
If you have inline code blocks, you can wrap them in backticks: `var example = true`.

If you've got a longer block of code, you can use ```:

-``` javascript
if (isAwesome){
	return true
}
```-
```
برای قرار دادن تیکه کد بصورت اینلاین میتوان آنرا در بین بک تیک قرار داد: `var example = true`.

و برای بلاک کد میتوان از ``` استفاده نمود:

``` javascript
if ( isAwesome ) {
	return true;
}
```

!> توجه شود که بمنظور بهم نخوردن مثال اول و آخر ``` علامت خط تیره قرار داده شده است که تکه کد در مثال بالا اجرا نشود

?> برای استفاده از هایلایت کد میتوان بعد از علامت ``` ابتدایی نام زبان مد نظر را درج کرد (bash - php - javascript - html - css)

---

# نکته
```
?> نکته: این یک نکته است
```
?> نکته: این یک نکته است

---

# هشدار
```
!> هشدار: این یک هشدار مهم است
```
!> **هشدار**: این یک هشدار مهم است

---