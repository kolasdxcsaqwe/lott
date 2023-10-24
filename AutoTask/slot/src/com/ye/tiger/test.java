package com.ye.tiger;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.math.BigDecimal;
import java.math.RoundingMode;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URI;
import java.net.URISyntaxException;
import java.net.URL;
import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Locale;

public class test {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Calendar calendar = Calendar.getInstance();
		SimpleDateFormat df = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		calendar.set(Calendar.MINUTE, 0);
		calendar.set(Calendar.SECOND, 0);
		calendar.set(Calendar.HOUR_OF_DAY, 0);
		
		System.err.println(df.format(calendar.getTime()));
		
		calendar.set(Calendar.MINUTE, 59);
		calendar.set(Calendar.SECOND, 59);
		calendar.set(Calendar.HOUR_OF_DAY, 23);
		
//		float kk=34121797.88f;
//		System.err.println(cutOff("34121797.889"));
//		
//		try {
//			URI uri=new URI("https://phones-web.g01gameapp.com/Q04e/android/lottery/apph5/Lottery_h5.apk");
//			URL url=new URL("https://phones-web.g01gameapp.com/Q04e/android/lottery/apph5/Lottery_h5.apk");
//			System.out.println(url.getHost());
//			System.out.println(url.getProtocol());
//			System.out.println(url.getPath());
//			System.out.println(uri.getHost());
//			System.out.println(uri.getPath());
//		} catch (MalformedURLException | URISyntaxException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}
		
		doamainTest("https://raw.githubusercontent.com/kolasdxcsaqwe/shihu/main/asd");
	}

	
	 //length 代表保留几位
    public static String cutOff(String val)
    {
        NumberFormat decimalFormat = DecimalFormat.getNumberInstance();
        if(val!=null)
        {
            try {
                String format = decimalFormat.format(new BigDecimal(val));
                return format;
            }
            catch (Exception ex)
            {
                ex.printStackTrace();
            }
        }

        return val;
    }
    
    //http://mp.weixinbridge.com/mp/wapredirect?url=http://xy.uy-37t2-xz0j28-jqkcifvn.com
    //http://mp.weixinbridge.com/mp/wapredirect?url=http://xy.new-cxz9734n-c6pvm9432.top
    public static void doamainTest(String pathUrl) {

		OutputStreamWriter out = null;
		BufferedReader br = null;
		String result = "";
		try {
			URL url = new URL(pathUrl);
			// 打开和url之间的连接
			HttpURLConnection conn = (HttpURLConnection) url.openConnection();
			// 请求方式
			// conn.setRequestMethod("POST");
			conn.setRequestMethod("GET");
		

			// 设置通用的请求属性
			conn.setRequestProperty("accept", "*/*");
			conn.setRequestProperty("connection", "Keep-Alive");
			conn.setRequestProperty("user-agent",
					"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
			conn.setRequestProperty("Content-Type",
					"application/json;charset=utf-8");

			// DoOutput设置是否向httpUrlConnection输出，DoInput设置是否从httpUrlConnection读入，此外发送post请求必须设置这两个
			conn.setDoOutput(true);
			conn.setDoInput(true);

			/**
			 * 下面的三句代码，就是调用第三方http接口
			 */
			// 获取URLConnection对象对应的输出流
			out = new OutputStreamWriter(conn.getOutputStream(), "UTF-8");
			// 发送请求参数即数据
			// out.write(data);
			// flush输出流的缓冲
			out.flush();

			/**
			 * 下面的代码相当于，获取调用第三方http接口后返回的结果
			 */
			// 获取URLConnection对象对应的输入流
			InputStream is = conn.getInputStream();
			// 构造一个字符流缓存
			br = new BufferedReader(new InputStreamReader(is));
			String str = "";
			while ((str = br.readLine()) != null) {
				result += str + "\n";
			}
			
			System.err.println(result);
			// 关闭流
			is.close();
			// 断开连接，disconnect是在底层tcp socket链接空闲时才切断，如果正在被其他线程使用就不切断。
			conn.disconnect();

		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			try {
				if (out != null) {
					out.close();
				}
				if (br != null) {
					br.close();
				}
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
	}
}
