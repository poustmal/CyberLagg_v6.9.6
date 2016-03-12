<?php

namespace CyberLagg;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;

class CyberLaggCommand extends Command implements PluginIdentifiableCommand {

  public $plugin;

  public function __construct(Loader $plugin) {
    parent::__construct("cyberlagg", "§aMenghapus lagg!", "/cyberlagg <check/clear/killmobs/clearall>", ["lagg"]);
    $this->setPermission("cyberlagg.command.clearlagg");
    $this->plugin = $plugin;
  }

  public function getPlugin() {
    return $this->plugin;
  }

  public function execute(CommandSender $sender, $alias, array $args) {
    if(!$this->testPermission($sender)) {
      return false;
    }
    if(isset($args[0])) {
      switch($args[0]) {
        case "clear":
         $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg§4] Menghapus " . $this->getPlugin()->removeEntities() . " §7entities.");
          return true;
        case "check":
        case "count":
          $c = $this->getPlugin()->getEntityCount();
          $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg§4] §bTerdeteksi " . $c[0] . " pemain, " . $c[1] . " mobs, dan " . $c[2] . " entities.");
          return true;
        case "reload":
          // TODO
          return true;
        case "killmobs":
          $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg§4] Menghapus " . $this->getPlugin()->removeMobs() . " §7mobs");
          return true;
        case "clearall":
         $sender->getServer() ->broadcastMessage("§4[§eCyber§bLagg] Menghapus " . ($d = $this->getPlugin()->removeMobs()) . " §7mobs" . ($d == 1 ? "" : "s") . " dan " . ($d = $this->getPlugin()->removeEntities()) . " entit" . ($d == 1 ? "y" : "ies") . ".");
          return true;
        case "area":
          // TODO
          return true;
        case "unloadchunks":
          // TODO
          return true;
        case "chunk":
          // TODO
          return true;
        case "tpchunk":
          // TODO
          return true;
        default:
          return false;
      }
    }
    return false;
  }

}
