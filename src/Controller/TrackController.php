<?php

namespace App\Controller;

use App\Entity\Page;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Track;

/**
 * Class TrackController
 * @package App\Controller\Track
 */
class TrackController extends AbstractController
{
    /**
     * @param ManagerRegistry $doctrine
     * @param $currentPage
     * @return Response
     */
    public function trackAction(ManagerRegistry $doctrine, $currentPage): Response
    {
        $user = $this->getUser();

        $u_agent = substr($_SERVER['HTTP_USER_AGENT'], 0, 35);
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip  = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if ($user) {
            return new Response ("");
        }
        $em = $doctrine->getManager();
        $track = new Track();

        $encryptedIp = openssl_encrypt($ip, "AES-256-CBC", "my personal ip", 0, hex2bin('34857d973953e44afb49ea9d61104d8c'));
        $track->setIp($encryptedIp);

        $track->setComputer(match (true) {
            (stripos(strtoupper($u_agent), 'ANDROID')) !== FALSE => 'Android',
            (stripos(strtoupper($u_agent), 'WINDOWS')) !== FALSE => 'Windows',
            (stripos(strtoupper($u_agent), 'MACINTOSH')) !== FALSE => 'Mac',
            (stripos(strtoupper($u_agent), 'LINUX')) !== FALSE => 'Linux',
            (stripos(strtoupper($u_agent), 'IPHONE')) !== FALSE => 'Iphone',
            (stripos(strtoupper($u_agent), 'IPAD')) !== FALSE => 'Ipad',
            (stripos(strtoupper($u_agent), 'FACEBOOK')) !== FALSE => 'Facebook',
            default => $u_agent
        });
        $track->setBrowser($u_agent);

        if (isset($_SERVER['HTTP_REFERER'])) {
            if (preg_match('/' . $_SERVER['HTTP_HOST'] . '/', $_SERVER['HTTP_REFERER'])) {
                $referer ='';
            }
            else {
                $referer = substr($_SERVER['HTTP_REFERER'], 0, 45);
            }
        }
        else {
            $referer ='';
        }

        $track->setPreviousPage(match (true) {
            (stripos(strtoupper($referer), 'FACEBOOK')) !== FALSE => 'Facebook',
            (stripos(strtoupper($referer), 'GOOGLE')) !== FALSE => 'Google',
            (stripos(strtoupper($referer), 'BING')) !== FALSE => 'Bing',
            (stripos(strtoupper($referer), 'MRIVIERE')) !== FALSE => 'Mriviere',
            (stripos(strtoupper($referer), 'AREAUNIVERSE')) !== FALSE => 'AreaUniverse',
            (stripos(strtoupper($referer), 'INSTAGRAM')) !== FALSE => 'Instagram',
            (stripos(strtoupper($referer), '.XYZ')) !== FALSE => 'Xyz',
            (stripos(strtoupper($referer), '82721527')) !== FALSE => '82721527',
            (stripos(strtoupper($referer), 'LINKEDIN')) !== FALSE, (stripos(strtoupper($referer), 'LNKD')) !== FALSE => 'Linkedin',
            (stripos(strtoupper($referer), 'TELEGRAM')) !== FALSE => 'Telegram',
            default => $referer
        });

        $pageNames = $doctrine->getRepository(Page::class)
            ->createQueryBuilder('p')
            ->select('p.name')
            ->orderBy('p.position', 'ASC')
            ->getQuery()
            ->getResult();

        $track->setPage(match (true) {
            $currentPage == 'first' => $pageNames[0]['name'],
            $currentPage == 'second' => $pageNames[1]['name'],
            $currentPage == 'third' => $pageNames[2]['name'],
            $currentPage == 'fourth' => $pageNames[3]['name'],
            $currentPage == 'fifth' => $pageNames[4]['name'],
            $currentPage == 'sixth' => $pageNames[5]['name'],
            $currentPage == 'seventh' => $pageNames[6]['name'],
            $currentPage == 'eighth' => $pageNames[7]['name'],
            $currentPage == 'ninth' => $pageNames[8]['name'],
            $currentPage == 'tenth' => $pageNames[9]['name'],
            default => $currentPage
        });

        $em->persist($track);
        $em->flush($track);

        return new Response ("");
    }
}