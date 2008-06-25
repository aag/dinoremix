LIMIT=1000

for ((i=1; i <= LIMIT; i++))
do
	wget http://www.qwantz.com/comics/comic2-$i.png
done

