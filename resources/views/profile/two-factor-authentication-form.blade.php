<x-action-section>
    <x-slot name="title">
        {{ __('การตรวจสอบสองขั้นตอน') }}
    </x-slot>

    <x-slot name="description">
        {{ __('เพิ่มความปลอดภัยให้บัญชีของคุณด้วยการตรวจสอบสองขั้นตอน') }}
    </x-slot>

    <x-slot name="content">
        <div class="mb-5">
            <h3 class="text-lg font-semibold text-gray-900">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        {{ __('กรุณาเสร็จสิ้นการตั้งค่าการตรวจสอบสองขั้นตอน') }}
                    @else
                        {{ __('การตรวจสอบสองขั้นตอนเปิดใช้งานแล้ว') }}
                    @endif
                @else
                    {{ __('การตรวจสอบสองขั้นตอนยังไม่เปิดใช้งาน') }}
                @endif
            </h3>
            <p class="text-gray-600">
                {{ __('เมื่อเปิดใช้งาน คุณจะต้องให้รหัสความปลอดภัยในระหว่างการเข้าสู่ระบบ ซึ่งคุณสามารถดึงรหัสจากแอป Google Authenticator ของคุณได้') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mb-5">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('สแกน QR โค้ดหรือลงรหัสการตั้งค่าเพื่อเสร็จสิ้นการตั้งค่า') }}
                        @else
                            {{ __('การตรวจสอบสองขั้นตอนของคุณเปิดใช้งานอยู่ สแกน QR โค้ดหรือลงรหัสการตั้งค่า') }}
                        @endif
                    </p>
                    <div class="mt-4 p-4 bg-white rounded shadow">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>
                    <p class="mt-4 font-semibold">
                        {{ __('รหัสการตั้งค่า') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('รหัส') }}" />
                        <x-input id="code" type="text" name="code" class="block mt-1 w-1/2"
                            inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />
                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mb-5">
                    <p class="font-semibold">
                        {{ __('เก็บรักษารหัสการกู้คืนเหล่านี้อย่างปลอดภัย เพื่อช่วยกู้คืนบัญชีของคุณหากอุปกรณ์ของคุณหาย') }}
                    </p>
                    <div class="grid gap-1 mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        <div class="flex gap-3 mt-5">
            @if (!$this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('เปิดใช้งาน') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button>
                            {{ __('สร้างรหัสการกู้คืนใหม่') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" wire:loading.attr="disabled">
                            {{ __('ยืนยัน') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button>
                            {{ __('แสดงรหัสการกู้คืน') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                <x-confirms-password wire:then="disableTwoFactorAuthentication">
                    @if ($showingConfirmation)
                        <x-secondary-button>
                            {{ __('ยกเลิก') }}
                        </x-secondary-button>
                    @else
                        <x-danger-button>
                            {{ __('ปิดใช้งาน') }}
                        </x-danger-button>
                    @endif
                </x-confirms-password>
            @endif
        </div>
    </x-slot>
</x-action-section>
