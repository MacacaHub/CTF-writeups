# CTF-Writeups

- 2021
	- BambooFox CTF 2021
	- HTCF Mid CTF 2021 (only for NSYSU course)

- 2020
    - TCat CTF 2020
	- TJCTF 2020
    - HTCF Mid CTF 2020 (only for NSYSU course)

- 2019
    - X-MAS CTF 2019
    - BambooFox CTF 2019 (2020 new year's eve)
    - AIS3 EOF CTF 2019


# Useful tool

## Web
- [Wireshark](https://www.wireshark.org/download.html)
- [Web-CTF-Cheatsheet](https://github.com/w181496/Web-CTF-Cheatsheet)
- [GitHacker](https://github.com/WangYihang/GitHacker): A Git source leak exploit tool that restores the entire Git repository.
- [Sublist3r](https://github.com/aboul3la/Sublist3r): Fast subdomains enumeration tool for penetration testers
- [nmap](https://github.com/nmap/nmap): Network discovery and security auditing.
	- Common command: `nmap -Pn -sT -sV -p0-65535 {target_ip}`
- [dirb](https://github.com/zardus/ctf-tools/blob/master/dirb/install)
- [sqlmap](https://github.com/sqlmapproject/sqlmap): Automatic SQL injection and database takeover tool.
- [wfuzz](https://github.com/xmendez/wfuzz): Web application fuzzer.
- Basic Command 
	- `ping`
	- `whois`
	- `nslookup`
	- `dig`
	- `traceroute`
	- `tcpdump`
- Chromium Extension
	- [EditThisCookie](https://chrome.google.com/webstore/detail/editthiscookie/fngmhnnpilhplaeedifhccceomclgfbg)
	- [Wappalyzer](https://chrome.google.com/webstore/detail/wappalyzer/gppongmhjkpfnbhagpmjfkannfbllamg)
	- [ModHeader](https://chrome.google.com/webstore/detail/modheader/idgpnmonknjnojddfkpgkljpfnnfcklj)

## Crypto
- [CTF overview (HackMD)](https://hackmd.io/@n2bzaPikTJOQuazqdQUyWg/ByAYpG-zZ)
- [factordb (online)](http://www.factordb.com/index.php)
- [quipquip (online)](https://quipqiup.com)
- [Cyberchef (online)](https://gchq.github.io/CyberChef/)
- [Hashcat](https://hashcat.net/hashcat/)
- [John the Ripper](https://github.com/openwall/john)
- [RsaCtfTool](https://github.com/Ganapati/RsaCtfTool): RSA attack tool (mainly for ctf).
- Wordlists
	- [rockyou.txt](https://github.com/praetorian-inc/Hob0Rules/blob/master/wordlists/rockyou.txt.gz)
	- [10k-most-common.txt](https://github.com/danielmiessler/SecLists/blob/master/Passwords/Common-Credentials/10k-most-common.txt)

## Malware Analysis (Reverse Engineering / Pwn / Forensics)

### File
- [CFF Explore](https://ntcore.com/?page_id=388): A powerful PE editor for analyzing and modifying executable files.
- [PE-bear](https://github.com/hasherezade/pe-bear): A multiplatform reversing tool for PE files, with a focus on malware analysis. (Open source)
- [PEStudio](https://www.winitor.com/download): A versatile tool for static analysis of PE files, with features for malware detection and optimization.
- [Stud_PE](https://www.cgsoftlabs.ro/studpe.html) (Long-term not updated): A portable PE editor with support for analyzing imports, exports, and other binary information.
- [PEiD](https://www.aldeid.com/wiki/PEiD): A popular tool for detecting packers, cryptors, and compilers used in PE files, with an extensive signature database.
- [Detect It Easy](https://github.com/horsicq/Detect-It-Easy): A cross-platform program for identifying file types and analyzing their structure, with support for custom signatures and plugins.
- [Exeinfo PE](https://github.com/ExeinfoASL/ASL): A fast and comprehensive tool for analyzing and debugging executable files, with support for unpacking and deobfuscating common packers and protectors.
- [FileAlyzer](https://www.safer-networking.org/products/filealyzer/): A feature-rich tool for analyzing and inspecting various file types, with a focus on security and privacy.

### Network
- [Wireshark](https://www.wireshark.org/download.html): A widely-used network protocol analyzer for Windows, Linux, and macOS.
- [Telerik Fiddler](https://www.telerik.com/fiddler): A free web debugging proxy tool that logs all HTTP(s) traffic between your computer and the internet.
- [scapy](https://scapy.net): A powerful Python-based interactive packet manipulation program and library.
- [FakeNet](https://github.com/mandiant/flare-fakenet-ng): A dynamic network analysis tool designed for malware analysis and cyber defense research.
- [Sysinternals Suite: TCPview](https://learn.microsoft.com/en-us/sysinternals/downloads/tcpview): A network monitoring tool that shows detailed listings of all TCP and UDP endpoints on a system, including local and remote addresses and state of TCP connections.

### Decompiler
- [hex-rays IDA](https://hex-rays.com/ida-pro/): A powerful and widely-used disassembler and debugger.
	- [capa](https://github.com/mandiant/capa): The FLARE team's open-source tool to identify capabilities in executable files.
- [Ghidra](https://github.com/NationalSecurityAgency/ghidra): An open source software (OSS) projects developed within the National Security Agency.
- [JD-GUI](http://java-decompiler.github.io): A fast Java decompiler.
- [pyinstxtractor](https://github.com/extremecoders-re/pyinstxtractor): A tool to extract PyInstaller executables.
- [Binary Ninja](https://binary.ninja): A reverse engineering platform and GUI.

### Debugger
- [hex-rays IDA](https://hex-rays.com/ida-pro/): A powerful and widely-used disassembler and debugger.
- [x64dbg](https://x64dbg.com): An open-source x64/x32 debugger for windows.
- [Ollydbg](https://www.ollydbg.de)  (long-term not updated): A 32-bit assembler level analysing debugger for MS Windows.
- [WinDbg](https://learn.microsoft.com/en-us/windows-hardware/drivers/debugger/): A multipurpose debugger for the MS Windows computer operating system, distributed by Microsoft.
- [dnSpy](https://github.com/dnSpy/dnSpy): .NET debugger and assembly editor.

### Others
- [pwntool](https://github.com/Gallopsled/pwntools): CTF framework and exploit development library.
- [Pwngdb](https://github.com/scwuaptx/Pwngdb): Developed by [Angelboy](https://github.com/scwuaptx).
- [010 editor](https://www.sweetscape.com/010editor/): A professional-grade text editor and hex editor designed to quickly and easily edit any file or drive.
- [HxD](https://mh-nexus.de/en/hxd/): A fast hex editor that, in addition to raw disk editing and modifying main memory (RAM), can handle files of any size.
- [Hiew](https://hiew.ru): View and edit files of any length in text, hex, and decode modes.
- [HashMyFile](https://www.nirsoft.net/utils/hash_my_files.html): Calculate file hashes and compare them for multiple files.
- [Process Hacker](https://processhacker.sourceforge.io): A free, powerful, multi-purpose tool that helps you monitor system resources, debug software and detect malware.
- [Systracer]()
- [Regshot](https://sourceforge.net/projects/regshot/): A free and open-source registry comparison tool that allows you to take snapshots of the Windows registry and compare them to identify any changes 
- [InstallRite](http://www.softsea.com/review/InstallRite.html) long-term not updated: A free utility tool that allows users to create a snapshot of the system before and after installing an application, making it easier to track changes the program.
- [Sysinternals Suite](https://learn.microsoft.com/en-us/sysinternals/downloads/sysinternals-suite): MS official tools, contains the individual troubleshooting tools and help files
	- [Process Monitor](https://learn.microsoft.com/en-us/sysinternals/downloads/procmon): An advanced monitoring tool for Windows that shows real-time file system, Registry and process/thread activity.
	- [Process Explorer](https://learn.microsoft.com/en-us/sysinternals/downloads/process-explorer)
	- [TCPview](https://learn.microsoft.com/en-us/sysinternals/downloads/tcpview)
	- [Autoruns](https://learn.microsoft.com/en-us/sysinternals/downloads/autoruns)
- Memory dump analysis
	- [Volatility](https://github.com/volatilityfoundation/volatility): An advanced memory forensics framework.
	- [Bulk Extractor](https://github.com/simsong/bulk_extractor): A C++ program that scans a disk image, a file, or a directory of files and extracts useful information without parsing the file system or file system structures.
- Basic linux command
	- `file`
	- `objdump`
	- `binwalk`


## Misc

### Steganography
- [aperisolve (online)](https://aperisolve.fr/)
- [stegsolve](https://github.com/zardus/ctf-tools/tree/master/stegsolve): Image stenography solver.
- [openstego](https://github.com/syvaidya/openstego): Steganography application provides "Data Hiding" & "Watermarking" functionalities.
- [TweakPNG](https://github.com/jsummers/tweakpng): A low-level PNG image file manipulation utility for Windows.
- [foremost](http://foremost.sourceforge.net)
- [QRazyBox](https://merricx.github.io/qrazybox/): QR Code Analysis and Recovery Toolkit.

### Others
- [Proof of Work (Balsn)](https://balsn.tw/proof-of-work/)
- [Metasploit](https://www.metasploit.com)
- [Empire](https://github.com/EmpireProject/Empire): A PowerShell and Python post-exploitation agent.
