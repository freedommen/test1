alter table ff_forecast_flow add province_id int(10) DEFAULT '0' COMMENT 'ʡ��id';
alter table ff_forecast_flow add city_id int(10) DEFAULT '0' COMMENT '����id';
alter table ff_visitor_age add `age_avg` int(10) DEFAULT '0' COMMENT 'ƽ������';
alter table ff_visitor_stay modify id int auto_increment;