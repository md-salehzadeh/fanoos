<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Setting\Entities\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        #############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'core.site_title';
		$setting->title = 'عنوان برنامه';
		$setting->description = 'عنوان برنامه';
		$setting->value = 'سیستم مدیریت محتوا فانوس';
		$setting->type = 'textfield';
		$setting->save();
		#############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'core.site_description';
		$setting->title = 'توضیحات مختصر برنامه';
		$setting->description = 'توضیحات مختصر برنامه';
		$setting->value = 'به جرات میشه گفت اگه بخوایم فقط سه رستوران تو رشت نام ببریم یکیش همین رارقی هست. هم کیفیت غذا، هم حرفه ای بودن پرسنل، هم مکان و هم دکور و نور زیبا.پیانوش هم جای خودشو داره.
صبحانشم که فوق العاده هست';
		$setting->type = 'textarea';
		$setting->save();
		#############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'core.site_template';
		$setting->title = 'قالب ادمین';
		$setting->description = 'قالب ادمین';
		$setting->value = '["ff", bb]';
		$setting->default = 'ff';
		$setting->type = 'select';
		$setting->save();
		#############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'core.site_email_template';
		$setting->title = 'تمپلیت ایمیل ارسالی به تیکت';
		$setting->description = 'تمپلیت ایمیل ارسالی به تیکت';
		$setting->value = '<div class="field-items"><div class="field-item even"><p><a href="http://tarafdari.com"><strong>به گزارش خبرنگار طرفداری- </strong></a>علی کریمی، هافبک استقلال پس از پیروزی تیمش مقابل نساجی قائم شهر در هفته بیست و دوم لیگ برتر اظهار داشت ا این سه امتیاز ما را در کورس قهرمانی نگه می&zwnj;دارد و هنوز امیدواریم که بعد از عید بازی&zwnj;های خوبی را به نمایش بگذاریم و امتیازات لازم را برای قهرمان شدن بدست بیاوریم.</p>

		<p>علی کریمی پس از <a href="https://www.tarafdari.com/node/1251513" target="_blank">پیروزی استقلال مقابل نساجی</a> گفت:</p>
		
		<blockquote>
		<p>خدا را شکر که توانستیم سه امتیاز این بازی را بگیریم چون برایمان خیلی مهم بود. ما تا حدودی خسته بودیم چون درگیر فشردگی مسابقات و لیگ قهرمانان آسیا بودیم. اما در این بازی موقعیت&zwnj;های متعددی داشتیم و استفاده نکردیم. اما این سه امتیاز ما را در کورس قهرمانی نگه می&zwnj;دارد و هنوز امیدواریم که بعد از عید بازی&zwnj;های خوبی را به نمایش بگذاریم و امتیازات لازم را برای قهرمان شدن بدست بیاوریم.</p>
		</blockquote>
		
		<blockquote>
		<p>ما یک بر صفر پیش بودیم و طبیعی بود که بازی را کنترل بکنیم و چشم به ضد حملات داشتیم که موقعیت&zwnj;های خوبی هم به وجود آمد ولی متاسفانه مثل بازی با العین نتوانستیم از آن استفاده کنیم. اما خدا را شکر نتیجه را حفظ کردیم.</p>
		</blockquote>
		
		<blockquote>
		<p>5 تیم برای قهرمانی می&zwnj;جنگند که ما یکی از این تیم&zwnj;ها هستیم و پرسپولیس هم یک تیم دیگر. 3 تیم دیگر هم در کورس هستند. تلاش می&zwnj;کنیم که بتوانیم سه امتیاز آن بازی را هم بگیریم و هنوز خودمان را در کورس نگه داریم. پرسپولیس هم یکی از بهترین تیم&zwnj;هایی هست که دو سال قهرمان شده و تیم یکدستی دارد و چند سال است که با هم کار می&zwnj;کنند. تمام تلاش خود را می&zwnj;کنیم که هواداران را شاد کنیم و بعد از چند سال برای آن&zwnj;ها قهرمانی بیاوریم.</p>
		</blockquote>
		
		<blockquote>
		<p>به قهرمانی خیلی امیدواریم. اگر 10 یا 11 بازی قبلی ما را ببینید نتایج گویای همه چیز هست و با خودمان عهد و پیمانی بستیم که تمام توانمان را برای قهرمانی تیم و خوشحالی هواداران بگذاریم. در پایان سال جدید را به همه مخصوصاً هواداران استقلال تبریک می&zwnj;گویم.</p>
		</blockquote>
		</div></div>';
		$setting->type = 'wysiwyg';
		$setting->save();
		#############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'core.site_primary_color';
		$setting->title = 'رنگ اصلی سایت';
		$setting->description = 'رنگ اصلی سایت';
		$setting->value = '#2f2f2f';
		$setting->type = 'colorpicker';
		$setting->save();
		#############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'module.user.avatar_ext';
		$setting->title = 'Avatar Allowed Extensions';
		$setting->description = 'Avatar Allowed Extensions';
		$setting->value = 'jpg,jpeg,png';
		$setting->type = 'tags';
		$setting->save();
		#############################################
		$setting = new Setting;
		$setting->module_id = 1;
		$setting->name = 'module.user.avatar_max_size';
		$setting->title = 'Avatar Max Size';
		$setting->description = 'Avatar Max Size';
		$setting->value = 5000;
		$setting->type = 'number';
		$setting->save();
		#############################################
    }
}
