<?php
use Illuminate\Database\Capsule\Manager as DB;

class SessionDatabase implements SessionHandlerInterface {

    /**
     * The database table we are currently using to store session information.
     */
    const DB_TABLE = "cms_core_sessions";

    /**
     * @param string $savePath
     * @param string $sessionName
     * @return bool
     */
    public function open($savePath, $sessionName) {
        return true;
    }

    /**
     * @return bool
     */
    public function close() {
        // Perform any necessary garbage collection before we shut down.
        return $this->gc(ini_get('session.gc_maxlifetime'));
    }

    /**
     * @param int $id
     * @return string
     */
    public function read($id) {
        $result = DB::table(self::DB_TABLE)->where('id', $id)->value('data');
        return $result;
    }

    /**
     * @param string $id
     * @param mixed $data
     * @return bool
     */
    public function write($id, $data) {
        $now = time();
        if (DB::table(self::DB_TABLE)->where('id', $id)->count() > 0) {
            DB::transaction(function () use ($id, $now, $data) {
                DB::table(self::DB_TABLE)->where('id', $id)->update(array(
                    'modified' => $now,
                    'data' => $data
                ));
            });
        } else {
            DB::transaction(function () use ($id, $now, $data) {
                DB::table(self::DB_TABLE)->insert(array(
                    'id' => $id,
                    'created' => $now,
                    'modified' => $now,
                    'data' => $data
                ));
            });
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function destroy($id) {
        return DB::table(self::DB_TABLE)->delete($id) > 0 ? true : false;
    }

    /**
     * @param int $maxLifeTime
     * @return bool
     */
    public function gc($maxLifeTime) {
        // Remove any sessions that haven't been modified within the specified amount of seconds.
        $expired = time() - $maxLifeTime;
        DB::table(self::DB_TABLE)->where('modified', '<', $expired)->delete();
        return true;
    }
}