<?php

function formatCurrency($amount) {
    // Nhân với 1000 vì giá trong database đang lưu theo đơn vị nghìn
    $amount = $amount * 1000;
    // Định dạng số theo format tiền Việt Nam
    return number_format($amount, 0, ',', '.') . '₫';
}

function formatCurrencyWithoutSymbol($amount) {
    // Nhân với 1000 vì giá trong database đang lưu theo đơn vị nghìn
    $amount = $amount * 1000;
    // Định dạng số không có ký hiệu tiền tệ
    return number_format($amount, 0, ',', '.');
} 