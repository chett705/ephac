@php
$logoImage = asset('storage/730462c5ff076ec199c20fa807f30cecc20de9ea (4).png');
$bgFooter  = asset('storage/bgFooter.png');
@endphp

<footer class="relative text-white pt-16 pb-10 overflow-hidden">
    
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ $bgFooter }}');">
    </div>

    <!-- Dark Overlay for better text readability -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#0a2a5e]/95 via-[#0f3b7a]/90 to-[#1e5bb8]/95"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10">

            <!-- Left Column - Logo + Description -->
            <div class="lg:col-span-5">
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ $logoImage }}" alt="EPHAC Logo" class="h-12 w-auto object-contain">
                </div>

                <div class="text-white/90 leading-relaxed text-[15px]">
                    <p class="mb-4">
                        EPHAC Co., Ltd. was established in Phnom Penh, Kingdom of Cambodia on 08-08-2008 and has well-known itself as a premier and global service oriented in the field of pharmaceutical manufacturing.
                    </p>
                    <p>
                        Currently, we serve over 100 commercial &amp; industrial importers &amp; exporters between Cambodia and Worldwide with high quality medicines.
                    </p>
                </div>
            </div>

            <!-- Information -->
            <div class="lg:col-span-3">
                <h3 class="text-white font-bold text-lg mb-6">Information</h3>
                <ul class="space-y-3 text-white/90">
                    <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Products</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Manufacturing</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Services</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">News</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Insights</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <!-- Keep in Touch -->
            <div class="lg:col-span-4">
                <h3 class="text-white font-bold text-lg mb-6">Keep in touch</h3>
                
                <div class="space-y-4 text-white/90 text-[15px]">
                    <p>
                        #86E0E1, Street NW 23, Phum Bayab,<br>
                        Sangkat Phnom Penh Thmey, Khan Sen Sok,<br>
                        Phnom Penh, Kingdom of Cambodia
                    </p>
                    <p>
                        <span class="font-medium text-white">(855) - 23 88 55 42</span><br>
                        <a href="mailto:info@ephac.com" class="hover:text-white">info@ephac.com</a><br>
                        <a href="#" class="hover:text-white">www.ephac.com</a>
                    </p>
                </div>

                <!-- Follow Us -->
                <div class="mt-8">
                    <h4 class="text-white font-bold mb-4">Follow us</h4>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com/LaboratoiresEPHAC/photos?locale=ga_IE" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all"><i class="fab fa-telegram-plane"></i></a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-16 pt-8 border-t border-white/20 flex flex-col md:flex-row justify-between items-center text-sm text-white/70">
            <div>
                © {{ date('Y') }} EPHAC Co., LTD. All rights reserved.
            </div>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Term of Service</a>
            </div>
        </div>
    </div>
</footer>