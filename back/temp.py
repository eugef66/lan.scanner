



def check_output():
	result = "Interface: enp7s0, type: EN10MB, MAC: 7c:10:c9:40:d7:1f, IPv4: 192.168.1.5\r\n" 
	result += "Starting arp-scan 1.9.7 with 256 hosts (https://github.com/royhills/arp-scan)\r\n" 
	#result += "192.168.1.1\t18:78:d4:36:74:3c\tVerizon\r\n" 
	result += "192.168.1.2\t24:4b:fe:c0:3f:f8\tASUSTek COMPUTER INC.\r\n" 
	result += "192.168.1.3\t50:eb:f6:15:23:98\tASUSTek COMPUTER INC.\r\n" 
	result += "192.168.1.13\t1c:f2:9a:29:c8:b3\tGoogle, Inc.\r\n" 
	result += "192.168.1.15\t3c:8c:f8:a1:86:9a\tTRENDnet, Inc.\r\n" 
	result += "192.168.1.20\t9c:ad:ef:60:8e:5e\tObihai Technology, Inc.\r\n" 
	result += "192.168.1.7\t00:22:58:70:a0:f7\tTaiyo Yuden Co., Ltd.\r\n" 
	result += "192.168.1.51\t94:b8:6d:b9:8d:d6\tIntel Corporate\r\n" 
	result += "192.168.1.59\t34:48:ed:30:b2:a9\tDell Inc.\r\n" 
	result += "192.168.1.16\tf0:ad:4e:0e:a1:89\tGlobalscale Technologies, Inc.\r\n" 
	result += "192.168.1.72\td8:31:34:62:52:6c\tRoku, Inc\r\n" 
	result += "192.168.1.35\t68:c6:3a:8b:79:b1\tEspressif Inc.\r\n" 
	result += "192.168.1.42\tdc:68:eb:67:67:3c\tNintendo Co.,Ltd\r\n" 
	result += "192.168.1.32\t20:1f:3b:d0:a1:5d\tGoogle, Inc.\r\n" 
	result += "192.168.1.14\t64:cb:e9:d1:9d:42\tLG Innotek\r\n" 
	result += "192.168.1.74\t84:ea:ed:b3:4f:e0\tRoku, Inc\r\n" 
	result += "192.168.1.10\td8:28:c9:36:a7:2a\tGeneral Electric Consumer and Industrial\r\n" 
	result += "192.168.1.255\t1c:f2:9a:29:c8:b3\tGoogle, Inc.\r\n" 
	result += "\r\n" 
	result += "18 packets received by filter, 0 packets dropped by kernel\r\n" 
	result += "Ending arp-scan 1.9.7: 256 hosts scanned in 1.233 seconds (207.62 hosts/sec). 18 responded"
	return result