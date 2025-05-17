<?php

namespace App\Rules\Dashboard;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Category;

class ValidParentCategory implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value) {
            return; // إذا لم يتم تحديد أب، لا توجد حاجة للتحقق
        }

        // التحقق من أن المعرف المُدخل هو لفئة موجودة
        $parentCategory = Category::find($value);

        if (!$parentCategory) {
            $fail( __('dashboard.categories.parent_not_found'));
            return;
        }

        // التحقق من أن الفئة الأب ليست فئة فرعية
        if ($parentCategory->parent) {
            $fail(__('dashboard.categories.invalid_parent_category'));
        }
    }

    /**
     * رسالة الخطأ الافتراضية.
     */
    public function message()
    {
        return __('dashboard.categories.invalid_parent_category');
    }
}
