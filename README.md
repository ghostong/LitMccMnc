# LitMccMnc

phpComposer: MCC MCN相关转换

### mcc 转 国家名称

````php
var_dump(\Lit\MccMnc\Mcc::toCountryName('460'));
string(5) "China"
````

### mcc 转 国家iso简码

````php
var_dump(\Lit\MccMnc\Mcc::toCountryISO('460'));
string(2) "cn"
````

### mnc mnc 转 运营商名称

````php
var_dump(\Lit\MccMnc\Mnc::toNetwork('460', '04'));
string(12) "China Mobile"
````
