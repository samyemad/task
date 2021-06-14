<?php
namespace Enums;

class CountriesRegex
{
    const MOROCOOREGEX = "\\\\(212\\\\)\\\\ ?[5-9]\\\\d{8}$";

    const CAMERRONREGEX = "\\\\(237\\\\)\\\\ ?[2368]\\\\d{7,8}$";

    const ETHIOPIAREGEX = "\\\\(251\\\\)\\\\ ?[1-59]\\\\d{8}$";

    const MOZAMBIQUEREGEX = "\\\\(258\\\\)\\\\ ?[28]\\\\d{7,8}$";

    const UGANDAREGEX = "\\\\(256\\\\)\\\\ ?\\\\d{9}$";
}
