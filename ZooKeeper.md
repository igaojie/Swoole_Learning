# ZooKeeper
## 安装
### brew install zookeeper
```
ShaodeMacBook-Pro:~ ShaoGaoJie$ brew search zookeeper
==> Searching local taps...
homebrew/php/php53-zookeeper             homebrew/php/php54-zookeeper             homebrew/php/php55-zookeeper             homebrew/php/php56-zookeeper             zookeeper
==> Searching taps on GitHub...
==> Searching blacklisted, migrated and deleted formulae...
ShaodeMacBook-Pro:~ ShaoGaoJie$ brew install zookeeper
==> Downloading https://homebrew.bintray.com/bottles/zookeeper-3.4.10.high_sierra.bottle.1.tar.gz
######################################################################## 100.0%
==> Pouring zookeeper-3.4.10.high_sierra.bottle.1.tar.gz
==> Caveats
To have launchd start zookeeper now and restart at login:
  brew services start zookeeper
Or, if you don't want/need a background service you can just run:
  zkServer start
==> Summary
🍺  /usr/local/Cellar/zookeeper/3.4.10: 241 files, 31.4MB


## 启动
ShaodeMacBook-Pro:~ ShaoGaoJie$ zkServer
ZooKeeper JMX enabled by default
Using config: /usr/local/etc/zookeeper/zoo.cfg
Usage: ./zkServer.sh {start|start-foreground|stop|restart|status|upgrade|print-cmd}

配置文件为 /usr/local/etc/zookeeper/zoo.cfg

ShaodeMacBook-Pro:~ ShaoGaoJie$
ShaodeMacBook-Pro:~ ShaoGaoJie$
ShaodeMacBook-Pro:~ ShaoGaoJie$ zkServer start
ZooKeeper JMX enabled by default
Using config: /usr/local/etc/zookeeper/zoo.cfg
Starting zookeeper ... STARTED

1. 这个时候Mac弹框提示 【您需要安装 JDK 才能使用“java”命令行工具。点按“更多信息…”来访问 Java 开发工具包下载网站。】点击 更多信息 去下载。
2. 下载安装，这就不一一赘述了。
3. 安装完毕之后，打开https://java.com/zh_CN/download/installed.jsp可以进行验证。

ShaodeMacBook-Pro:~ ShaoGaoJie$ java --version
No Java runtime present, requesting install.

4.http://www.oracle.com/technetwork/java/javase/downloads/jdk9-downloads-3848520.html 下载jdk。 


5. 再次启动
ShaodeMacBook-Pro:~ ShaoGaoJie$ java --version
java 9.0.4
Java(TM) SE Runtime Environment (build 9.0.4+11)
Java HotSpot(TM) 64-Bit Server VM (build 9.0.4+11, mixed mode)
ShaodeMacBook-Pro:~ ShaoGaoJie$ zkServer start
ZooKeeper JMX enabled by default
Using config: /usr/local/etc/zookeeper/zoo.cfg
Starting zookeeper ... STARTED
ShaodeMacBook-Pro:~ ShaoGaoJie$ ps -ef | grep zook
  501 47328     1   0  5:33下午 ttys022    0:01.70 /usr/bin/java -Dzookeeper.log.dir=. -Dzookeeper.root.logger=INFO,CONSOLE -cp /usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../build/classes:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../build/lib/*.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../lib/slf4j-log4j12-1.6.1.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../lib/slf4j-api-1.6.1.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../lib/netty-3.10.5.Final.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../lib/log4j-1.2.16.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../lib/jline-0.9.94.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../zookeeper-3.4.10.jar:/usr/local/Cellar/zookeeper/3.4.10/libexec/bin/../src/java/lib/*.jar:/usr/local/etc/zookeeper: -Dcom.sun.management.jmxremote -Dcom.sun.management.jmxremote.local.only=false org.apache.zookeeper.server.quorum.QuorumPeerMain /usr/local/etc/zookeeper/zoo.cfg

通过nc 或者 telnet 访问2181端口 判断zookeeper服务是否启动成功
ShaodeMacBook-Pro:~ ShaoGaoJie$ echo ruok | nc localhost 2181
imok

ShaodeMacBook-Pro:~ ShaoGaoJie$ echo conf | nc localhost 2181
clientPort=2181------zookeeper监听客户端连接的端口默认是2181
dataDir=/usr/local/var/run/zookeeper/data/version-2   ------持久化数据存放的目录
dataLogDir=/usr/local/var/run/zookeeper/data/version-2
tickTime=2000---------zookeeper中基本时间单元，单位是毫秒
maxClientCnxns=60
minSessionTimeout=4000
maxSessionTimeout=40000
serverId=0
ShaodeMacBook-Pro:~ ShaoGaoJie$ netstat -an | grep 2181
tcp46      0      0  *.2181                 *.*                    LISTEN
tcp4       0      0  127.0.0.1.54671        127.0.0.1.2181         TIME_WAIT
ShaodeMacBook-Pro:~ ShaoGaoJie$
```

### 命令
|Category|Command|Description|
|:--|:--|:--|
|Server status| ruok |Tests if server is running in a non-error state. The server will respond with imok if it is running. Otherwise it will not respond at all.A response of "imok" does not necessarily indicate that the server has joined the quorum, just that the server process is active and bound to the specified client port. Use "stat" for details on state wrt quorum and client connection information.|
|| conf |Print details about serving configuration.|
|| envi |Print details about serving environment|
||srvr|Lists full details for the server.|
|| stat |Lists brief details for the server and connected clients.|
|| srst |Reset server statistics.|
|Client connections|dump||
||cons|List full connection/session details for all clients connected to this server. Includes information on numbers of packets received/sent, session id, operation latencies, last operation performed, etc.|
||crst|Reset connection/session statistics for all connections.|
|Watches|wchs| Lists brief information on watches for the server.|
||wchc|Lists detailed information on watches for the server, by session. This outputs a list of sessions(connections) with associated watches (paths). Note, depending on the number of watches this operation may be expensive (ie impact server performance), use it carefully.|
||wchp|Lists detailed information on watches for the server, by path. This outputs a list of paths (znodes) with associated sessions. Note, depending on the number of watches this operation may be expensive (ie impact server performance), use it carefully.|
|Monitoring|mntr|Outputs a list of variables that could be used for monitoring the health of the cluster.|

#### 命令案例
```
$ echo mntr | nc localhost 2181
zk_version	3.4.10-39d3a4f269333c922ed3db283be479f9deacaa0f, built on 03/23/2017 10:13 GMT
zk_avg_latency	0
zk_max_latency	0
zk_min_latency	0
zk_packets_received	4
zk_packets_sent	3
zk_num_alive_connections	1
zk_outstanding_requests	0
zk_server_state	standalone
zk_znode_count	4
zk_watch_count	0
zk_ephemerals_count	0
zk_approximate_data_size	27
zk_open_file_descriptor_count	23
zk_max_file_descriptor_count	10240
ShaodeMacBook-Pro:~ ShaoGaoJie$
ShaodeMacBook-Pro:~ ShaoGaoJie$
```