<?php

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

$action = $_GET['action'] ?? null;

if (!$action) {
    header("Content-Type: text/html; charset=UTF-8");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sky Gateway - API Docs</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .mono { font-family: 'JetBrains Mono', monospace; }
            .glass-effect {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            }
            .api-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                border: 1.5px solid #f1f5f9;
            }
            .api-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            }
            .input-box {
                transition: all 0.2s;
                border: 1.5px solid #f1f5f9;
                background: #f8fafc;
            }
            .input-box:focus {
                background: #fff;
                border-color: #6366f1;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
                outline: none;
            }
            .endpoint-display {
                background: #0f172a;
                color: #94a3b8;
                padding: 0.75rem 1rem;
                border-radius: 12px;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.7rem;
                display: flex;
                align-items: center;
                overflow-x: auto;
            }
            .endpoint-display b { color: #f8fafc; font-weight: 500; }
            .result-container {
                display: none;
                background: #020617;
                border-radius: 12px;
                margin-top: 1rem;
                padding: 1rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.75rem;
                color: #10b981;
                max-height: 300px;
                overflow-y: auto;
                border: 1px solid #1e293b;
            }
            ::-webkit-scrollbar-track { background: transparent; }
        </style>
    </head>
    <body class="bg-white text-slate-900 selection:bg-indigo-100 selection:text-indigo-700">

        <nav class="glass-effect fixed top-0 w-full z-50">
            <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-sm shadow-indigo-200">
                        <i class="fa-solid fa-bolt-lightning text-white"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-tight">Sky Gateway</span>
                        <p class="text-xs text-slate-600 font-medium">Orderkuota API Unofficial</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="#" class="hover:text-indigo-600 transition">Documentation</a>
                    <a href="#" class="hover:text-indigo-600 transition">API Reference</a>
                    <div class="h-4 w-[1px] bg-slate-200"></div>
                    <span class="flex items-center gap-2 text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-full text-xs">
                        <span class="w-1.5 h-1.5 bg-indigo-600 rounded-full animate-pulse"></span>
                        System Operational
                    </span>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-6 pt-28 pb-16">

            <!-- Grid 3 kolom -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Card Create Payment -->
                <div class="api-card bg-white rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-qrcode text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: createpayment</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Create QRIS Payment</h3>
                        <p class="text-sm text-slate-600 mb-4">Generate link gambar QRIS dinamis secara real-time.</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlCreate" class="truncate">loading...</span>
                            <button onclick="copyUrl('urlCreate')" class="ml-auto hover:text-white transition"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>

                    <form id="formCreate" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyCreate" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                <input type="text" id="userCreate" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Amount</label>
                                <input type="number" id="amtCreate" placeholder="e.g. 10000" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div class="col-span-2">
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Auth Token</label>
                                <input type="text" id="tokenCreate" placeholder="Token" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-indigo-600 transition shadow-lg shadow-slate-200">Execute Request</button>
                    </form>
                    <pre id="resCreate" class="result-container"></pre>
                </div>

                <!-- Card Mutasi -->
                <div class="api-card bg-white rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-list-check text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: mutasiqr</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Check Mutation</h3>
                        <p class="text-sm text-slate-600 mb-4">Verifikasi riwayat transaksi masuk pada akun Anda.</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlMutasi" class="truncate">loading...</span>
                            <button onclick="copyUrl('urlMutasi')" class="ml-auto hover:text-white transition"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>

                    <form id="formMutasi" class="space-y-4">
                        <div class="space-y-4">
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyMutasi" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                    <input type="text" id="userMutasi" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-slate-600 ml-1">Token</label>
                                    <input type="text" id="tokenMutasi" placeholder="Token" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-slate-200">Check History</button>
                    </form>
                    <pre id="resMutasi" class="result-container"></pre>
                </div>

                <!-- Card Cek Profile (BARU) -->
                <div class="api-card bg-white rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-id-card text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: cekprofile</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Cek Profil</h3>
                        <p class="text-sm text-slate-600 mb-4">Lihat informasi akun OrderKuota (saldo, nama, dll).</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlCekProfile" class="truncate">loading...</span>
                            <button onclick="copyUrl('urlCekProfile')" class="ml-auto hover:text-white transition"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>

                    <form id="formCekProfile" class="space-y-4">
                        <div class="space-y-4">
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyCekProfile" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                    <input type="text" id="userCekProfile" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-slate-600 ml-1">Token</label>
                                    <input type="text" id="tokenCekProfile" placeholder="Token" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-teal-600 transition shadow-lg shadow-slate-200">Lihat Profil</button>
                    </form>
                    <pre id="resCekProfile" class="result-container"></pre>
                </div>

                <!-- Card Get OTP -->
                <div class="api-card bg-white rounded-3xl p-8 border-dashed border-2">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-shield-halved text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: getotp</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Step 1: Request OTP</h3>
                        <p class="text-sm text-slate-600 mb-4">Kirim kode OTP ke nomor terdaftar OrderKuota.</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlOtp" class="truncate">loading...</span>
                        </div>
                    </div>

                    <form id="formOtp" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyOtp" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                <input type="text" id="userOtp" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Password</label>
                                <input type="text" id="passOtp" placeholder="Pass App" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-slate-200">Request Code</button>
                    </form>
                    <pre id="resOtp" class="result-container"></pre>
                </div>

                <!-- Card Get Token -->
                <div class="api-card bg-white rounded-3xl p-8 border-dashed border-2">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-key text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: gettoken</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Step 2: Get Session Token</h3>
                        <p class="text-sm text-slate-600 mb-4">Tukarkan kode OTP dengan Auth Token permanen.</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlToken" class="truncate">loading...</span>
                        </div>
                    </div>

                    <form id="formToken" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyToken" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                <input type="text" id="userToken" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">OTP Code</label>
                                <input type="text" id="otpValue" placeholder="6 Digit" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-slate-200">Finalize Authentication</button>
                    </form>
                    <pre id="resToken" class="result-container"></pre>
                </div>

                <!-- Card Withdraw QRIS -->
                <div class="api-card bg-white rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: wdqr</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Withdraw QRIS</h3>
                        <p class="text-sm text-slate-600 mb-4">Tarik saldo QRIS dari akun OrderKuota Anda.</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlWdqr" class="truncate">loading...</span>
                            <button onclick="copyUrl('urlWdqr')" class="ml-auto hover:text-white transition"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>

                    <form id="formWdqr" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyWdqr" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                <input type="text" id="userWdqr" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Amount</label>
                                <input type="number" id="amtWdqr" placeholder="e.g. 50000" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div class="col-span-2">
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Auth Token</label>
                                <input type="text" id="tokenWdqr" placeholder="Token" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-rose-600 transition shadow-lg shadow-slate-200">Withdraw Now</button>
                    </form>
                    <pre id="resWdqr" class="result-container"></pre>
                </div>

                <!-- Card Cek Ewallet -->
                <div class="api-card bg-white rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center">
                            <i class="fa-solid fa-wallet text-xl"></i>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-slate-100 rounded-lg text-slate-600">Action: cekewallet</span>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-bold mb-1">Cek Ewallet</h3>
                        <p class="text-sm text-slate-600 mb-4">Periksa nama akun e-wallet (Dana, OVO, GoPay, dll).</p>
                        <div class="endpoint-display">
                            <span class="shrink-0 mr-2 text-indigo-400 font-bold text-[10px]">GET</span>
                            <span id="urlCekEwallet" class="truncate">loading...</span>
                            <button onclick="copyUrl('urlCekEwallet')" class="ml-auto hover:text-white transition"><i class="fa-regular fa-copy"></i></button>
                        </div>
                    </div>

                    <form id="formCekEwallet" class="space-y-4">
                        <div class="space-y-4">
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">API Key</label>
                                <input type="text" id="keyCekEwallet" placeholder="••••••••••••" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Provider</label>
                                <select id="providerCekEwallet" class="input-box w-full rounded-xl px-4 py-3 text-sm appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2220%22%20height%3D%2220%22%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%221.5%22%3E%3Cpath%20d%3D%22m6%208%204%204%204-4%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.5rem] bg-[right_0.5rem_center] bg-no-repeat">
                                    <option value="dana">Dana</option>
                                    <option value="ovo">OVO</option>
                                    <option value="gopay">GoPay</option>
                                    <option value="shopeepay">ShopeePay</option>
                                    <option value="linkaja">LinkAja</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[11px] font-bold text-slate-600 ml-1">Username</label>
                                    <input type="text" id="userCekEwallet" placeholder="Username" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                                </div>
                                <div>
                                    <label class="text-[11px] font-bold text-slate-600 ml-1">Token</label>
                                    <input type="text" id="tokenCekEwallet" placeholder="Token" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                                </div>
                            </div>
                            <div>
                                <label class="text-[11px] font-bold text-slate-600 ml-1">Nomor</label>
                                <input type="text" id="nomorCekEwallet" placeholder="08xxxxxxxxxx" class="input-box w-full rounded-xl px-4 py-3 text-sm">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white font-semibold py-3.5 rounded-xl hover:bg-cyan-600 transition shadow-lg shadow-slate-200">Check Now</button>
                    </form>
                    <pre id="resCekEwallet" class="result-container"></pre>
                </div>

            </div>
        </main>

        <footer class="max-w-7xl mx-auto px-6 py-10 border-t border-slate-200/60 text-center md:text-left">
            <div class="flex flex-col md:flex-row justify-between items-center gap-2">
                <p class="text-sm text-slate-600 font-medium">© 2026 Skyzopedia Developer Team.</p>
                <div class="flex gap-4">
                    <a href="https://whatsapp.com/channel/0029VbCI57Q30LKMthhW160r" class="text-slate-600 hover:text-indigo-600 transition"><i class="fa-brands fa-whatsapp text-lg"></i></a>
                    <a href="https://t.me/Xskycode" class="text-slate-600 hover:text-indigo-600 transition"><i class="fa-brands fa-telegram text-lg"></i></a>
                </div>
            </div>
        </footer>

        <script>
            const BASE_URL = window.location.origin + window.location.pathname;

            function updateUrls() {
                // Create Payment
                const cKey = document.getElementById('keyCreate').value || '{apikey}';
                const cUser = document.getElementById('userCreate').value || '{username}';
                const cAmt = document.getElementById('amtCreate').value || '{amount}';
                const cTok = document.getElementById('tokenCreate').value || '{token}';
                document.getElementById('urlCreate').innerText = `${BASE_URL}?action=createpayment&apikey=${cKey}&username=${cUser}&amount=${cAmt}&token=${cTok}`;

                // Mutasi
                const mKey = document.getElementById('keyMutasi').value || '{apikey}';
                const mUser = document.getElementById('userMutasi').value || '{username}';
                const mTok = document.getElementById('tokenMutasi').value || '{token}';
                document.getElementById('urlMutasi').innerText = `${BASE_URL}?action=mutasiqr&apikey=${mKey}&username=${mUser}&token=${mTok}`;

                // Cek Profile (BARU)
                const pKey = document.getElementById('keyCekProfile').value || '{apikey}';
                const pUser = document.getElementById('userCekProfile').value || '{username}';
                const pTok = document.getElementById('tokenCekProfile').value || '{token}';
                document.getElementById('urlCekProfile').innerText = `${BASE_URL}?action=cekprofile&apikey=${pKey}&username=${pUser}&token=${pTok}`;

                // Get OTP
                const oKey = document.getElementById('keyOtp').value || '{apikey}';
                const oUser = document.getElementById('userOtp').value || '{username}';
                const oPass = document.getElementById('passOtp').value || '{password}';
                document.getElementById('urlOtp').innerText = `${BASE_URL}?action=getotp&apikey=${oKey}&username=${oUser}&password=${oPass}`;

                // Get Token
                const tKey = document.getElementById('keyToken').value || '{apikey}';
                const tUser = document.getElementById('userToken').value || '{username}';
                const tOtp = document.getElementById('otpValue').value || '{otp}';
                document.getElementById('urlToken').innerText = `${BASE_URL}?action=gettoken&apikey=${tKey}&username=${tUser}&otp=${tOtp}`;

                // Withdraw QRIS
                const wKey = document.getElementById('keyWdqr').value || '{apikey}';
                const wUser = document.getElementById('userWdqr').value || '{username}';
                const wAmt = document.getElementById('amtWdqr').value || '{amount}';
                const wTok = document.getElementById('tokenWdqr').value || '{token}';
                document.getElementById('urlWdqr').innerText = `${BASE_URL}?action=wdqr&apikey=${wKey}&username=${wUser}&amount=${wAmt}&token=${wTok}`;

                // Cek Ewallet
                const eKey = document.getElementById('keyCekEwallet').value || '{apikey}';
                const eProv = document.getElementById('providerCekEwallet').value || 'dana';
                const eUser = document.getElementById('userCekEwallet').value || '{username}';
                const eTok = document.getElementById('tokenCekEwallet').value || '{token}';
                const eNomor = document.getElementById('nomorCekEwallet').value || '{nomor}';
                document.getElementById('urlCekEwallet').innerText = `${BASE_URL}?action=cekewallet&apikey=${eKey}&provider=${eProv}&username=${eUser}&token=${eTok}&nomor=${eNomor}`;
            }

            document.querySelectorAll('input, select').forEach(el => {
                el.addEventListener('input', updateUrls);
                el.addEventListener('change', updateUrls);
            });

            async function copyUrl(id) {
                const text = document.getElementById(id).innerText;
                await navigator.clipboard.writeText(text);
                alert('Endpoint URL copied to clipboard!');
            }

            async function handleRequest(e, action, params, resId) {
                e.preventDefault();
                const resBox = document.getElementById(resId);
                resBox.style.display = 'block';
                resBox.innerHTML = '<span class="text-slate-600 animate-pulse">// Processing request...</span>';
                
                const query = new URLSearchParams({ action, ...params }).toString();
                try {
                    const response = await fetch(`${BASE_URL}?${query}`);
                    const data = await response.json();
                    resBox.innerHTML = JSON.stringify(data, null, 2);
                } catch (err) {
                    resBox.innerHTML = '// Error: ' + err.message;
                }
            }

            document.getElementById('formCreate').onsubmit = (e) => handleRequest(e, 'createpayment', {
                apikey: document.getElementById('keyCreate').value,
                username: document.getElementById('userCreate').value,
                amount: document.getElementById('amtCreate').value,
                token: document.getElementById('tokenCreate').value
            }, 'resCreate');

            document.getElementById('formMutasi').onsubmit = (e) => handleRequest(e, 'mutasiqr', {
                apikey: document.getElementById('keyMutasi').value,
                username: document.getElementById('userMutasi').value,
                token: document.getElementById('tokenMutasi').value
            }, 'resMutasi');

            // Form Cek Profile (BARU)
            document.getElementById('formCekProfile').onsubmit = (e) => handleRequest(e, 'cekprofile', {
                apikey: document.getElementById('keyCekProfile').value,
                username: document.getElementById('userCekProfile').value,
                token: document.getElementById('tokenCekProfile').value
            }, 'resCekProfile');

            document.getElementById('formOtp').onsubmit = (e) => handleRequest(e, 'getotp', {
                apikey: document.getElementById('keyOtp').value,
                username: document.getElementById('userOtp').value,
                password: document.getElementById('passOtp').value
            }, 'resOtp');

            document.getElementById('formToken').onsubmit = (e) => handleRequest(e, 'gettoken', {
                apikey: document.getElementById('keyToken').value,
                username: document.getElementById('userToken').value,
                otp: document.getElementById('otpValue').value
            }, 'resToken');

            document.getElementById('formWdqr').onsubmit = (e) => handleRequest(e, 'wdqr', {
                apikey: document.getElementById('keyWdqr').value,
                username: document.getElementById('userWdqr').value,
                amount: document.getElementById('amtWdqr').value,
                token: document.getElementById('tokenWdqr').value
            }, 'resWdqr');

            document.getElementById('formCekEwallet').onsubmit = (e) => handleRequest(e, 'cekewallet', {
                apikey: document.getElementById('keyCekEwallet').value,
                provider: document.getElementById('providerCekEwallet').value,
                username: document.getElementById('userCekEwallet').value,
                token: document.getElementById('tokenCekEwallet').value,
                nomor: document.getElementById('nomorCekEwallet').value
            }, 'resCekEwallet');

            updateUrls();
        </script>
    </body>
    </html>
    <?php
    exit;
}

// ==================== API LOGIC ====================
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

if (!class_exists('OrderKuota')) {
    class OrderKuota
    {
        const API_URL = 'https://app.orderkuota.com/api/v2';
        const HOST = 'app.orderkuota.com';
        const USER_AGENT = 'okhttp/4.12.0';
        const KONCI_RAHASIA = 'orderkuota_mobile_app_2024';

        private $authToken;
        private $username;

        private $appVersionName;
        private $appVersionCode;
        private $appRegId;
        private $phoneModel;
        private $phoneUuid;
        private $phoneAndroidVersion;

        private $androidVersions = ['15'];
        private $phoneModels = [
            'SM-G973F'
        ];
        private $appVersions     = ['260115'];
        private $appVersionNames = ['26.01.15'];

        public function __construct($username = null, $authToken = null)
        {
            $this->username   = $username;
            $this->authToken  = $authToken;
            $this->generateDeviceFingerprint();
        }

        public function getDeviceInfo()
        {
            return [
                'app_reg_id'              => $this->appRegId,
                'phone_uuid'              => $this->phoneUuid,
                'phone_model'             => $this->phoneModel,
                'phone_android_version'   => $this->phoneAndroidVersion,
                'app_version_code'        => $this->appVersionCode,
                'app_version_name'        => $this->appVersionName,
            ];
        }

        private function generateDeviceFingerprint()
        {
            $rawUuid = bin2hex(random_bytes(16));
            $this->phoneUuid = sprintf('%s-%s-%s-%s-%s',
                substr($rawUuid, 0, 8),
                substr($rawUuid, 8, 4),
                substr($rawUuid, 12, 4),
                substr($rawUuid, 16, 4),
                substr($rawUuid, 20, 12)
            );

            $fcmHash = hash('sha256', random_bytes(16));
            $this->appRegId = $this->phoneUuid . ':APA91b' . substr($fcmHash, 0, 100);

            $this->phoneModel           = $this->phoneModels[array_rand($this->phoneModels)];
            $this->phoneAndroidVersion  = $this->androidVersions[array_rand($this->androidVersions)];

            $indexApp = array_rand($this->appVersions);
            $this->appVersionCode = $this->appVersions[$indexApp];
            $this->appVersionName = $this->appVersionNames[$indexApp];
        }

        private function generateSignature($params, $timestamp)
        {
            ksort($params);
            $base = http_build_query($params) . '&timestamp=' . $timestamp . '&secret=' . self::KONCI_RAHASIA;
            return hash_hmac('sha256', $base, self::KONCI_RAHASIA);
        }

        public function login($username, $password)
        {
            $request_time = round(microtime(true) * 1000);
            $payload = http_build_query([
                'username'                => $username,
                'password'                => $password,
                'request_time'            => $request_time,
                'app_reg_id'              => $this->appRegId,
                'phone_android_version'   => $this->phoneAndroidVersion,
                'app_version_code'        => $this->appVersionCode,
                'phone_uuid'              => $this->phoneUuid,
            ]);
            $response = $this->request('POST', self::API_URL . '/login', $payload, true);
            return json_decode($response, true);
        }

        public function generateQr($amount)
        {
            $request_time = round(microtime(true) * 1000);
            $payload = http_build_query([
                'request_time'                            => $request_time,
                'app_reg_id'                              => $this->appRegId,
                'phone_android_version'                   => $this->phoneAndroidVersion,
                'app_version_code'                        => $this->appVersionCode,
                'phone_uuid'                              => $this->phoneUuid,
                'auth_username'                           => $this->username,
                'auth_token'                              => $this->authToken,
                'requests[qris_merchant_terms][jumlah]'    => $amount,
                'requests[0]'                             => 'qris_merchant_terms',
                'app_version_name'                        => $this->appVersionName,
                'phone_model'                             => $this->phoneModel,
            ]);
            $response = $this->request('POST', self::API_URL . '/get', $payload, true);
            $data = json_decode($response, true);
            if (isset($data['success'], $data['qris_merchant_terms']['results'])) {
                return $data['qris_merchant_terms']['results'];
            }
            return $data;
        }

        public function withdraw($amount)
        {
            $request_time = round(microtime(true) * 1000);
            $payload = http_build_query([
                'request_time'                            => $request_time,
                'app_reg_id'                              => $this->appRegId,
                'phone_android_version'                   => $this->phoneAndroidVersion,
                'app_version_code'                        => $this->appVersionCode,
                'phone_uuid'                              => $this->phoneUuid,
                'auth_username'                           => $this->username,
                'auth_token'                              => $this->authToken,
                'requests[qris_withdraw][amount]'         => $amount,
                'requests[0]'                             => 'account',
                'app_version_name'                        => $this->appVersionName,
                'ui_mode'                                 => 'light',
                'phone_model'                             => $this->phoneModel,
            ]);
            $response = $this->request('POST', self::API_URL . '/get', $payload, true);
            return json_decode($response, true);
        }

        public function getTransactionQris()
        {
            $resellerId = explode(':', $this->authToken)[0];
            $request_time = round(microtime(true) * 1000);

            $paramsForSign = [
                'auth_username' => $this->username,
                'auth_token'    => $this->authToken,
                'phone_uuid'    => $this->phoneUuid,
                'request_time'  => $request_time,
            ];
            $signature = $this->generateSignature($paramsForSign, $request_time);

            $payload = http_build_query([
                'app_reg_id'                              => $this->appRegId,
                'phone_uuid'                              => $this->phoneUuid,
                'phone_model'                             => $this->phoneModel,
                'requests[qris_history][keterangan]'      => '',
                'requests[qris_history][jumlah]'          => '',
                'requests[qris_history][jenis]'           => '1',
                'request_time'                            => $request_time,
                'phone_android_version'                   => $this->phoneAndroidVersion,
                'app_version_code'                        => $this->appVersionCode,
                'auth_username'                           => $this->username,
                'requests[qris_history][page]'            => '1',
                'auth_token'                              => $this->authToken,
                'app_version_name'                        => $this->appVersionName,
                'ui_mode'                                 => 'light',
                'requests[qris_history][dari_tanggal]'     => '',
                'requests[0]'                             => 'account',
                'requests[qris_history][ke_tanggal]'       => '',
            ]);

            $extraHeaders = [
                'signature: ' . $signature,
                'timestamp: ' . $request_time,
            ];

            $url = self::API_URL . '/qris/mutasi/' . $resellerId;
            $response = $this->request('POST', $url, $payload, true, $extraHeaders);
            return json_decode($response, true);
        }

        // ==================== METHOD BARU: getProfile ====================
        public function getProfile()
        {
            $request_time = round(microtime(true) * 1000);
            $paramsForSign = [
                'auth_username' => $this->username,
                'auth_token'    => $this->authToken,
                'phone_uuid'    => $this->phoneUuid,
                'request_time'  => $request_time,
            ];
            $signature = $this->generateSignature($paramsForSign, $request_time);

            $payload = http_build_query([
                'app_reg_id'            => $this->appRegId,
                'phone_uuid'            => $this->phoneUuid,
                'phone_model'           => $this->phoneModel,
                'request_time'          => $request_time,
                'phone_android_version' => $this->phoneAndroidVersion,
                'app_version_code'      => $this->appVersionCode,
                'auth_username'         => $this->username,
                'requests[2]'           => 'home_toolbar_button',
                'requests[1]'           => 'point',
                'requests[0]'           => 'account',
                'auth_token'            => $this->authToken,
                'app_version_name'      => $this->appVersionName,
                'ui_mode'               => 'light',
            ]);

            $extraHeaders = [
                'signature: ' . $signature,
                'timestamp: ' . $request_time,
            ];

            $url = self::API_URL . '/get';
            $response = $this->request('POST', $url, $payload, true, $extraHeaders);
            return json_decode($response, true);
        }

        protected function buildHeaders($extraHeaders = [])
        {
            $headers = [
                'Host: ' . self::HOST,
                'User-Agent: ' . self::USER_AGENT,
                'Content-Type: application/x-www-form-urlencoded',
                'Accept-Encoding: gzip',
            ];
            return array_merge($headers, $extraHeaders);
        }

        protected function request($method, $url, $postData = null, $useHeaders = true, $extraHeaders = [])
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            if ($postData !== null) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            }
            if ($useHeaders) {
                curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeaders($extraHeaders));
            }
            $result = curl_exec($ch);
            $error  = curl_error($ch);
            if ($error) {
                return json_encode(['error' => 'CURL error: ' . $error]);
            }
            return $result;
        }
    }
}

if (!function_exists('convertCRC16')) {
    function convertCRC16($str) {
        $crc = 0xFFFF;
        for ($c = 0; $c < strlen($str); $c++) {
            $crc ^= ord($str[$c]) << 8;
            for ($i = 0; $i < 8; $i++) {
                $crc = ($crc & 0x8000) ? ($crc << 1) ^ 0x1021 : $crc << 1;
            }
        }
        return str_pad(strtoupper(dechex($crc & 0xFFFF)), 4, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('generateTransactionId')) {
    function generateTransactionId() {
        return 'SKY-' . strtoupper(bin2hex(random_bytes(3)));
    }
}

if (!function_exists('generateExpirationTime')) {
    function generateExpirationTime() {
        $exp = new DateTime();
        $exp->modify('+30 minutes');
        return $exp->format('Y-m-d H:i:s');
    }
}

if (!function_exists('uploadToPixhost')) {
    function uploadToPixhost($imagePath) {
        $url = 'https://api.pixhost.to/images';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $headers = [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36',
            'x-requested-with: XMLHttpRequest',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $postFields = [
            'content_type' => '0',
            'img' => new CURLFile($imagePath)
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        if ($curlError) throw new Exception("Pixhost upload curl error: $curlError");
        if ($httpCode != 200) throw new Exception("Pixhost upload HTTP $httpCode");
        $data = json_decode($response, true);
        if (!$data || !isset($data['show_url'])) throw new Exception("Pixhost response tidak valid");
        $showUrl = $data['show_url'];

        $ch2 = curl_init($showUrl);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch2, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36'
        ]);
        $html = curl_exec($ch2);
        $httpCode2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
        if ($httpCode2 != 200 || empty($html)) throw new Exception("Gagal mengambil halaman show_url");
        if (preg_match('/<img[^>]+class="image-img"[^>]+src="([^"]+)"/i', $html, $matches)) {
            $directUrl = $matches[1];
            if (strpos($directUrl, '//') === 0) $directUrl = 'https:' . $directUrl;
            elseif (strpos($directUrl, '/') === 0) $directUrl = 'https://pixhost.to' . $directUrl;
            return $directUrl;
        }
        throw new Exception("Tidak dapat menemukan URL gambar");
    }
}

if (!function_exists('uploadToUploadCC')) {
    function uploadToUploadCC($imagePath) {
        $url = 'https://upload.cc/image_upload';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $headers = [
            'Referer: https://upload.cc',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36'
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $postFields = [
            'uploaded_file[]' => new CURLFile($imagePath)
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        if ($curlError) throw new Exception("Upload.cc curl error: $curlError");
        if ($httpCode != 200) throw new Exception("Upload.cc HTTP $httpCode");
        $data = json_decode($response, true);
        if (!$data || !isset($data['code']) || $data['code'] != 100 || empty($data['success_image'])) {
            throw new Exception("Upload.cc response tidak valid: " . $response);
        }
        $imageUrl = $data['success_image'][0]['url'];
        $directLink = 'https://upload.cc/' . ltrim($imageUrl, '/');
        return $directLink;
    }
}

if (!function_exists('uploadToTmpNinja')) {
    function uploadToTmpNinja($imagePath) {
        $url = 'https://tmp.ninja/upload';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($imagePath)]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) throw new Exception("tmp.ninja HTTP $httpCode");
        $data = json_decode($response, true);
        if (!$data || !isset($data['file']['url'])) throw new Exception("tmp.ninja response tidak valid");
        return $data['file']['url'];
    }
}

if (!function_exists('uploadToCatbox')) {
    function uploadToCatbox($imagePath) {
        $url = 'https://catbox.moe/user/api.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'reqtype' => 'fileupload',
            'fileToUpload' => new CURLFile($imagePath)
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) throw new Exception("catbox.moe HTTP $httpCode");
        $url = trim($response);
        if (!filter_var($url, FILTER_VALIDATE_URL)) throw new Exception("catbox.moe response bukan URL valid");
        return $url;
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($imagePath) {
        if (!file_exists($imagePath)) throw new Exception("File tidak ditemukan");
        $lastError = '';
        try { return uploadToPixhost($imagePath); } catch (Exception $e) { $lastError = 'Pixhost: ' . $e->getMessage(); }
        try { return uploadToUploadCC($imagePath); } catch (Exception $e) { $lastError .= ' | UploadCC: ' . $e->getMessage(); }
        try { return uploadToTmpNinja($imagePath); } catch (Exception $e) { $lastError .= ' | Tmp.ninja: ' . $e->getMessage(); }
        try { return uploadToCatbox($imagePath); } catch (Exception $e) { $lastError .= ' | Catbox: ' . $e->getMessage(); }
        throw new Exception("Semua host gagal: $lastError");
    }
}

if (!function_exists('createQRIS')) {
    function createQRIS($amount, $qrisString) {
        $qrisData = substr($qrisString, 0, -4);
        $step1 = str_replace("010211", "010212", $qrisData);
        $step2 = explode("5802ID", $step1);
        $uang = "54" . str_pad(strlen($amount), 2, '0', STR_PAD_LEFT) . $amount . "5802ID";
        $final = $step2[0] . $uang . $step2[1];
        $result = $final . convertCRC16($final);

        $qrApiUrl = "https://api.qrserver.com/v1/create-qr-code/";
        $params = http_build_query([
            'size'   => '400x400',
            'margin' => 25,
            'data'   => $result
        ]);

        $ch = curl_init($qrApiUrl . '?' . $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        $imageData = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception("CURL Error: " . curl_error($ch));
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode !== 200 || empty($imageData)) {
            throw new Exception("Gagal generate QR code (HTTP $httpCode)");
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'qris_') . '.png';
        file_put_contents($tempFile, $imageData);
        if (!file_exists($tempFile) || filesize($tempFile) == 0) {
            throw new Exception("File QR gagal dibuat");
        }

        $imageUrl = uploadImage($tempFile);
        unlink($tempFile);

        return [
            'idtransaksi' => generateTransactionId(),
            'jumlah'      => $amount,
            'expired'     => generateExpirationTime(),
            'imageqris'   => ['url' => $imageUrl], 
            'qr_string'      => $result
        ];
    }
}

if (!function_exists('cekEwallet')) {
    function cekEwallet($provider, $nomor, $username, $token, $orderkuota = null) {
        $validProviders = ["dana", "ovo", "gopay", "shopeepay", "linkaja"];
        if (!in_array($provider, $validProviders)) {
            return [
                "status" => false,
                "error" => "Provider tidak valid",
                "valid_providers" => $validProviders
            ];
        }

        if (!$orderkuota instanceof OrderKuota) {
            $orderkuota = new OrderKuota();
        }
        $device = $orderkuota->getDeviceInfo();

        $timestamp = round(microtime(true) * 1000);

        $payload = http_build_query([
            'app_reg_id'            => $device['app_reg_id'],
            'phone_uuid'            => $device['phone_uuid'],
            'phone_model'           => $device['phone_model'],
            'phoneNumber'           => $nomor,
            'request_time'          => $timestamp,
            'phone_android_version' => $device['phone_android_version'],
            'app_version_code'      => $device['app_version_code'],
            'auth_username'         => $username,
            'customerId'            => '',
            'id'                    => $provider,
            'auth_token'            => $token,
            'app_version_name'      => $device['app_version_name'],
            'ui_mode'               => 'dark'
        ]);

        $url = "https://checker.orderkuota.com/api/checkname/produk/5db26e7b429d49106145635bf5f0436f8c1f43323b/25/2088243/dana?phone=083164465401&cust_id=&b=0&t=f746e94f";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: okhttp/4.12.0',
            'Accept-Encoding: gzip',
            'Content-Type: application/x-www-form-urlencoded',
            'signature: 63c7cce025a219cf50ad08513d2a669e1c7bacf3233e42810aa42ced97eca2e6c6a926afd5afd93eb2fd90854e045d12921a2c84049f8096f4ec2b849097e940',
            'timestamp: ' . $timestamp
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            return ["status" => false, "error" => "CURL error: " . $error];
        }
        if ($httpCode != 200) {
            return ["status" => false, "error" => "HTTP $httpCode", "raw" => $response];
        }

        $data = json_decode($response, true);
        return ["status" => true, "result" => $data];
    }
}

try {

$valid_api_keys = [
    'skyy7',
    'Lyyncode', 
    'Time160110', 
    'luxzz02', 
    'KhafaCode'
];

$api_key = $_GET['apikey'] ?? '';

if (!in_array($api_key, $valid_api_keys, true)) {
    throw new Exception("API Key tidak valid.");
}

    $action = $_GET['action'] ?? null;

    if ($action === 'getotp') {
        $username = $_GET['username'] ?? '';
        $password = $_GET['password'] ?? '';
        if (empty($username) || empty($password)) {
            throw new Exception("Parameter 'username' dan 'password' wajib diisi.");
        }
        $orderkuota = new OrderKuota();
        $response = $orderkuota->login($username, $password);

        echo json_encode([
            "status" => true,
            "action" => "getotp",
            "result" => $response
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    if ($action === 'gettoken') {
        $username = $_GET['username'] ?? '';
        $otp = $_GET['otp'] ?? '';
        if (empty($username) || empty($otp)) {
            throw new Exception("Parameter 'username' dan 'otp' wajib diisi.");
        }
        $orderkuota = new OrderKuota();
        $response = $orderkuota->login($username, $otp);

        echo json_encode([
            "status" => true,
            "action" => "gettoken",
            "result" => $response
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    if ($action === 'createpayment') {
        $username = $_GET['username'] ?? '';
        $token = $_GET['token'] ?? '';
        $amount = (int)($_GET['amount'] ?? 0);
        if (empty($username) || empty($token)) {
            throw new Exception("Parameter 'username' dan 'token' wajib diisi.");
        }
        if ($amount <= 0) throw new Exception("Nominal 'amount' harus > 0");
        
        $orderkuota = new OrderKuota($username, $token);
        $qrResponse = $orderkuota->generateQr($amount);
        if (!isset($qrResponse['qris_data'])) {
            $errorMsg = is_array($qrResponse) ? json_encode($qrResponse) : 'No qris_data';
            throw new Exception("Gagal QRIS: $errorMsg");
        }
        $qrisResult = createQRIS($amount, $qrResponse['qris_data']);

        echo json_encode([
            "status" => true,
            "action" => "createpayment",
            "result" => [
                "trxid" => $qrisResult['idtransaksi'],
                "nominal" => $qrisResult['jumlah'],
                "expired" => $qrisResult['expired'],
                "qris_image" => $qrisResult['imageqris']['url'], 
                "qris_string" => $qrisResult['qr_string'],
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    if ($action === 'mutasiqr') {
        $username = $_GET['username'] ?? '';
        $token = $_GET['token'] ?? '';
        if (empty($username) || empty($token)) {
            throw new Exception("Parameter 'username' dan 'token' wajib diisi.");
        }
        $orderkuota = new OrderKuota($username, $token);
        $mutasi = $orderkuota->getTransactionQris();

        echo json_encode([
            "status" => true,
            "action" => "mutasiqr",
            "result" => $mutasi['qris_history'] ?? $mutasi
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    // ==================== ENDPOINT BARU: cekprofile ====================
    if ($action === 'cekprofile') {
        $username = $_GET['username'] ?? '';
        $token = $_GET['token'] ?? '';
        if (empty($username) || empty($token)) {
            throw new Exception("Parameter 'username' dan 'token' wajib diisi.");
        }
        $orderkuota = new OrderKuota($username, $token);
        $profile = $orderkuota->getProfile();

        echo json_encode([
            "status" => true,
            "action" => "cekprofile",
            "result" => $profile['account']['results'] ?? $profile
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    if ($action === 'wdqr') {
        $username = $_GET['username'] ?? '';
        $token = $_GET['token'] ?? '';
        $amount = (int)($_GET['amount'] ?? 0);
        if (empty($username) || empty($token)) {
            throw new Exception("Parameter 'username' dan 'token' wajib diisi.");
        }
        if ($amount <= 0) throw new Exception("Nominal 'amount' harus > 0");

        $orderkuota = new OrderKuota($username, $token);
        $wdResponse = $orderkuota->withdraw($amount);

        echo json_encode([
            "status" => true,
            "action" => "wdqr",
            "result" => $wdResponse
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    if ($action === 'cekewallet') {
        $provider = strtolower($_GET['provider'] ?? '');
        $nomor = $_GET['nomor'] ?? '';
        $username = $_GET['username'] ?? '';
        $token = $_GET['token'] ?? '';
        if (empty($provider) || empty($nomor) || empty($username) || empty($token)) {
            throw new Exception("Parameter 'provider', 'nomor', 'username', dan 'token' wajib diisi.");
        }

        $orderkuota = new OrderKuota(); // hanya untuk device fingerprint
        $result = cekEwallet($provider, $nomor, $username, $token, $orderkuota);

        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    throw new Exception("Action tidak valid. Gunakan 'getotp', 'gettoken', 'createpayment', 'mutasiqr', 'cekprofile', 'wdqr', 'cekewallet'.");

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
