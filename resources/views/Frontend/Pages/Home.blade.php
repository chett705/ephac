@extends('Frontend.Layout.Main')

@section('content')
    <section class="relative overflow-hidden bg-[linear-gradient(180deg,#ffffff_0%,#ffffff_58%,#d7f3ff_58%,#bee9ff_100%)]">
        <div class="mx-auto max-w-[1500px] px-4 pb-10 pt-4 sm:px-6 lg:px-8 lg:pb-16">
            <div class="relative overflow-hidden rounded-[28px] bg-[linear-gradient(135deg,#cdeefe_0%,#b8def8_45%,#add6f2_100%)] px-8 py-14 shadow-[0_30px_80px_rgba(76,144,214,0.28)] sm:px-12 lg:px-18 lg:py-20">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_20%,rgba(255,255,255,0.42),transparent_28%),radial-gradient(circle_at_84%_18%,rgba(255,255,255,0.32),transparent_22%),radial-gradient(circle_at_50%_100%,rgba(28,92,215,0.18),transparent_30%)]"></div>

                <div class="relative grid items-center gap-12 lg:grid-cols-[0.92fr_1.08fr]">
                    <div class="max-w-xl">
                        <h1 class="text-6xl font-extrabold leading-none tracking-tight text-[#ff1717] sm:text-7xl">
                            EPHAC
                        </h1>

                        <p class="mt-4 max-w-lg text-3xl font-medium leading-tight text-[#184ab7] sm:text-[3rem]">
                            Trusted Pharmaceutical Manufacturer in Cambodia
                        </p>

                        <p class="mt-5 max-w-md text-sm leading-6 text-[#26438b] sm:text-[15px]">
                            consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut.
                        </p>

                        <div class="mt-10 flex flex-col gap-4 sm:flex-row">
                            <a href="#contact"
                                class="inline-flex min-w-[164px] items-center justify-center rounded-full bg-[#134ddc] px-8 py-4 text-lg font-semibold text-white transition hover:bg-[#0f41bb]">
                                Contact Us
                            </a>
                            <a href="#products"
                                class="inline-flex min-w-[164px] items-center justify-center rounded-full bg-[#134ddc] px-8 py-4 text-lg font-semibold text-white transition hover:bg-[#0f41bb]">
                                Explore Products
                            </a>
                        </div>
                    </div>

                    <div class="relative flex min-h-[520px] items-center justify-center">
                        <div class="absolute bottom-6 h-10 w-64 rounded-full bg-[#0e4fd2]/35 blur-2xl"></div>

                        <div class="relative h-[430px] w-[300px]">
                            <div class="absolute left-1/2 top-0 h-[180px] w-[155px] -translate-x-1/2 rounded-t-[80px] rounded-b-[18px] bg-[linear-gradient(180deg,#ffffff_0%,#eef7ff_20%,#2195eb_68%,#216fdd_100%)] shadow-[0_8px_28px_rgba(18,95,194,0.24)]"></div>
                            <div class="absolute left-1/2 top-[158px] h-[22px] w-[180px] -translate-x-1/2 rounded-full bg-white/40 blur-md"></div>
                            <div class="absolute bottom-0 left-1/2 h-[175px] w-[170px] -translate-x-1/2 rounded-b-[85px] rounded-t-[18px] bg-[linear-gradient(180deg,#ffffff_0%,#edf4ff_55%,#cfd8e8_100%)] shadow-[0_20px_40px_rgba(27,89,179,0.18)]"></div>

                            <div class="absolute left-[34px] top-[168px] h-16 w-16 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#d8edff_26%,#48acef_70%,#3492dd_100%)] shadow-md"></div>
                            <div class="absolute left-[12px] top-[140px] h-10 w-10 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[70px] top-[133px] h-8 w-8 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[84px] top-[188px] h-8 w-8 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[48px] top-[222px] h-8 w-8 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[33px] top-[170px] h-1 w-10 rotate-[38deg] bg-white/70"></div>
                            <div class="absolute left-[53px] top-[154px] h-1 w-8 rotate-[-26deg] bg-white/70"></div>
                            <div class="absolute left-[70px] top-[194px] h-1 w-9 rotate-[56deg] bg-white/70"></div>
                            <div class="absolute left-[45px] top-[205px] h-1 w-8 rotate-[-52deg] bg-white/70"></div>

                            <div class="absolute right-[38px] top-[194px] h-16 w-16 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#d8edff_26%,#48acef_70%,#3492dd_100%)] shadow-md"></div>
                            <div class="absolute right-[16px] top-[169px] h-10 w-10 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute right-[77px] top-[159px] h-8 w-8 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute right-[93px] top-[215px] h-8 w-8 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute right-[39px] top-[244px] h-8 w-8 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute right-[38px] top-[186px] h-1 w-10 rotate-[-40deg] bg-white/70"></div>
                            <div class="absolute right-[62px] top-[172px] h-1 w-7 rotate-[26deg] bg-white/70"></div>
                            <div class="absolute right-[74px] top-[215px] h-1 w-8 rotate-[-54deg] bg-white/70"></div>
                            <div class="absolute right-[50px] top-[234px] h-1 w-8 rotate-[48deg] bg-white/70"></div>

                            <div class="absolute left-1/2 top-[124px] h-[72px] w-[72px] -translate-x-1/2 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#d8edff_26%,#48acef_70%,#3492dd_100%)] shadow-lg"></div>
                            <div class="absolute left-[126px] top-[86px] h-10 w-10 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[92px] top-[148px] h-9 w-9 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[168px] top-[147px] h-9 w-9 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[144px] top-[206px] h-9 w-9 rounded-full bg-[radial-gradient(circle_at_30%_30%,#ffffff_0%,#dbf3ff_35%,#53b9f7_100%)]"></div>
                            <div class="absolute left-[121px] top-[110px] h-1 w-9 rotate-[127deg] bg-white/70"></div>
                            <div class="absolute left-[115px] top-[151px] h-1 w-8 rotate-[28deg] bg-white/70"></div>
                            <div class="absolute left-[154px] top-[151px] h-1 w-8 rotate-[-28deg] bg-white/70"></div>
                            <div class="absolute left-[146px] top-[189px] h-1 w-7 rotate-[70deg] bg-white/70"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
