<div>
    <x-input-label for="update_password_password" :value="__('كلمة المرور الجديدة')" />
    <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
        autocomplete="new-password" />
    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور الجديدة')" />
    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
        class="mt-1 block w-full" autocomplete="new-password" />
    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
</div>