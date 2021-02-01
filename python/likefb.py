import requests
from lxml import html
import time
import random
def auto_like(link):
        cookie = 'c_user=100000207480628; xs=20%3ADqOoNkSQzHyONA%3A2%3A1595994489%3A5893%3A6381; presence=EDvF3EtimeF1596982012EuserFA21B00207480628A2EstateFDsb2F1596970262943EatF1596981979477Et3F_5b_5dEutc3F1596981979496G596982012571CEchF_7bCC'
        headers = {
            'authority': 'mbasic.facebook.com',
            'upgrade-insecure-requests': '1',
            'user-agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
            'accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'sec-fetch-site': 'same-origin',
            'sec-fetch-mode': 'navigate',
            'accept-language': 'en-US,en;q=0.9',
            'cookie': cookie
        }
        page = requests.get(
            'https://mbasic.facebook.com' + link,
            headers=headers
        )
        tree = html.fromstring(page.content)
        like_posts = tree.xpath("//a[contains(@href,'a/subscribe.php')]/@href")
        for link in like_posts:
            res = requests.get('https://mbasic.facebook.com' + link, headers=headers)
            print(link)
            time.sleep(random.choice(range(2)))

auto_like('/lovemyself1992')