insert into `promotion` (`id`, `name`, `type`, `adjustment`, `criteria`)
values
    (1, 'Black Friday half price sale', 'date_range_multiplier', 0.5, '{\"to\":\"2022-11-28\", \"from\": \"2022-11-25\"}'),
    (2, 'Voucher OU812', 'fixed_price_voucher', 100, '{\"code\":\"OU812\"}');
