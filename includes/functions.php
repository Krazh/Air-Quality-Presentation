<?php

function GetMonth($i) {
    switch ($i):
        case 1:
            return "January";
        case 2:
            return "February";
        case 3:
            return "March";
        case 4:
            return "April";
        case 5:
            return "May";
        case 6:
            return "June";
        case 7:
            return "July";
        case 8:
            return "August";
        case 9:
            return "September";
        case 10:
            return "October";
        case 11:
            return "November";
        case 12:
            return "December";
    endswitch;
}

function GetLimitValue($i) {
    switch ($i):
    case 68:
        return 50;
    case 135:
        return 25;
    case 136:
        return 10;
    case 138:
        return 40;
    case 141:
        return 40;
    case 144:
        return 125;
    case 147:
        return 120;
    case 161:
        return 50;
    case 162:
        return 25;
    endswitch;
}